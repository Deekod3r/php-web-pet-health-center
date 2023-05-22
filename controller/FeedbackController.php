<?php
class FeedbackController extends BaseController
{

    public function feedback_page()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->render_view(
                'feedback'
            );
        } else $this->render_error('400');
    }

    public function feedback_page_ad()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->check_admin() && ($this->check_admin_role(Enum::ROLE_MANAGER) || $this->check_admin_role(Enum::ROLE_NEWS))) {
                $this->render_view(
                    'feedback'
                );
            } else $this->render_error('403');
        } else $this->render_error('400');
    }

    public function data_feedback()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $limit = 0;
                $offset = 0;
                $feedbackModel = $this->get_model('feedback');
                $count = $feedbackModel->count_data("");
                if ($count > 0) {
                    $key = " order by fb_time DESC ";
                    if (isset($_GET['limit']) and $_GET['limit'] != '') {
                        $limit = $_GET['limit'];
                        if ($limit > 0) {
                            $key .= " limit " . $limit;
                            if (isset($_GET['index']) and $_GET['index'] != '') {
                                $index = $_GET['index'];
                                if ($index > 1) {
                                    $offset = ($index - 1) * $limit;
                                }
                                if ($offset > 0) {
                                    $key .= " offset " . $offset;
                                }
                            }
                        }
                    }
                    $feedbackData = $feedbackModel->get_data($key);
                    $responseCode = ResponseCode::SUCCESS;
                    $message = "SERV: " . sprintf(ResponseMessage::SELECT_MESSAGE, "feedback", "thành công.");
                    $data = [
                        'feedback' => $feedbackData,
                        'count' => $count
                    ];
                } else {
                    $responseCode = ResponseCode::DATA_EMPTY;
                    $message = "SERV: " . sprintf(ResponseMessage::DATA_EMPTY_MESSAGE, "feedback");
                }
            } else {
                $responseCode = ResponseCode::REQUEST_INVALID;
                $message = "SERV: " . sprintf(ResponseMessage::REQUEST_INVALID_MESSAGE);
            }
        } catch (Exception $e) {
            $responseCode = ResponseCode::UNKNOWN_ERROR;
            $message = "SERV: " . $e->getMessage();
        }
        $this->response($responseCode, $message, $data);
    }

    public function send_feedback()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($this->check_login()) {
                $token = isset($_POST['token']) && $_POST['token'] != null ? $_POST['token'] : '';
                $dataToken = $this->verify_and_decode_token($token);
                if (!$dataToken) {
                    $responseCode = ResponseCode::TOKEN_INVALID;
                    $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE;
                } else {
                    if (isset($_POST['fbContent']) && $_POST['fbContent'] != '' && isset($_POST['rating']) && $_POST['rating'] != '') {
                        $id = json_decode($dataToken)->{'id'};
                        $customer = $this->get_model('customer')->get_by_id($id);
                        if ($customer != null) {
                            if ($customer['ctm_can_feedback']) {
                                $dataFeedback = [
                                    'content' => $_POST['fbContent'],
                                    'rating' => $_POST['rating'],
                                    'time' => date('Y-m-d H:i:s'),
                                    'ctmId' => $id,
                                ];
                                $feedbackModel = $this->get_model('feedback');
                                if ($feedbackModel->save_data($dataFeedback)) {
                                    $responseCode = ResponseCode::SUCCESS;
                                    $message = "SERV: " . sprintf(ResponseMessage::INSERT_MESSAGE, "đánh giá", "thành công");
                                } else {
                                    $message = "SERV: " . sprintf(ResponseMessage::INSERT_MESSAGE, "đánh giá", "thất bại");
                                }
                            } else {
                                $message = "SERV: " . "Hãy sử dụng dịch vụ của CarePET và quay lại đánh giá sau";
                            }
                        } else {
                            $responseCode = ResponseCode::OBJECT_DOES_NOT_EXIST;
                            $message = "SERV: " . sprintf(ResponseMessage::OBJECT_DOES_NOT_EXIST_MESSAGE, 'người dùng');
                        }
                    } else {
                        $responseCode = ResponseCode::INPUT_EMPTY;
                        $message = "SERV: " . sprintf(ResponseMessage::INPUT_EMPTY_MESSAGE, "đánh giá");
                    }
                }
            } else {
                $responseCode = ResponseCode::ACCESS_DENIED;
                $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE;
            }
        } else {
            $responseCode = ResponseCode::REQUEST_INVALID;
            $message = "SERV: " . sprintf(ResponseMessage::REQUEST_INVALID_MESSAGE);
        }
        $this->response($responseCode, $message, $data);
    }
}
