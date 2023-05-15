<?php
class FeedbackController extends BaseController
{

    public function feedback_page()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->render_view(
                'feedback'
            );
        } else include('view/error/error-400.php');
    }

    public function data_feedback()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $limit = 0;
            $offset = 0;
            $feedbackModel = $this->get_model('feedback');
            $count = $feedbackModel->count_data("");
            $key = " order by fb_time DESC ";
            if ($count > 0) {
                if (isset($_GET['limit']) and $_GET['limit'] != '') {
                    $limit = $_GET['limit'];
                    if ($limit > 0) {
                        $key .= " limit " . $limit;
                        if (isset($_GET['index']) and $_GET['index'] != '') {
                            $index = $_GET['index'];
                            if ($index > 1) {
                                $offset = ($index-1) * $limit; 
                            }
                            if ($offset > 0) {
                                $key .= " offset " . $offset;
                            }
                        }
                    }
                }
            }
            $feedback = $feedbackModel->get_data($key);
            $result = [
                "statusCode" => "1",
                "message" => "OK",
                "data" => [
                    'feedback' => $feedback,
                    'count' => $count
                ]
            ];
            echo json_encode($result);
        } else $this->redirect('home', 'index');
    }

    public function send_feedback()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($this->check_login()) {
                $token = $_POST['token'];
                $data = $this->verify_and_decode_token($token);
                if (!$data) {
                    $this->redirect('home', 'index');
                } else {
                    $id = json_decode($data)->{'id'};
                    $customer = $this->get_model('customer')->get_by_id($id);
                    if ($customer['ctm_can_feedback']) {
                        $data = [
                            'content' => $_POST['fbContent'],
                            'rating' => $_POST['rating'],
                            'time' => date('Y-m-d H:i:s'),
                            'ctmId' => $id,
                        ];
                        $feedbackModel = $this->get_model('feedback');
                        if ($feedbackModel->save_data($data)) {
                            $result = [
                                "statusCode" => "1",
                                "message" => "Phản hồi thành công.",
                                "data" => [
                                ]
                            ];
                            echo json_encode($result);
                        } else {
                            $result = [
                                "statusCode" => "0",
                                "message" => "Phản hồi thất bại.",
                                "data" => [
                                ]
                            ];
                            echo json_encode($result);
                        }
                    } else {
                        $result = [
                            "statusCode" => "-1",
                            "message" => "Hãy sử dụng thêm dịch vụ của CarePET và quay lại phản hồi sau.",
                            "data" => [
                            ]
                        ];
                        echo json_encode($result);
                    }                   
                }
            } else $this->redirect('home', 'index');
        }
    }
}
