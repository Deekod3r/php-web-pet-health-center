<?php
class BillController extends BaseController
{

    public function customer_history()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->check_login()) {
                $this->render_view(
                    'customer-history',
                );
            } else $this->redirect('home', 'index');
        } else include('view/error/error-400.php');
    }

    public function data_customer_history()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->check_login()) {
                $token = isset($_GET['token']) ? $_GET['token'] : '';
                $dataToken = $this->verify_and_decode_token($token);
                if (!$dataToken) {
                    $responseCode = ResponseCode::TOKEN_INVALID;
                    $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE;
                } else {
                    $limit = 0;
                    $offset = 0;
                    $id = json_decode($dataToken)->{'id'};
                    $billModel = $this->get_model('bill');
                    $count = $billModel->count_data_by_customer($id);
                    if ($count > 0) {
                        $key = " order by bill_date_release DESC ";
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
                        $bill = $billModel->get_data(" where ctm_id = $id " . $key);
                        $responseCode = ResponseCode::SUCCESS;
                        $message = "SERV: " . sprintf(ResponseMessage::SELECT_MESSAGE,'hoá đơn','thành công');
                        //$message = "SERV: " . " where ctm_id = $id " . $key;
                        $data = [
                            'bill' => $bill,
                            'count' => $count
                        ];
                    } else {
                        $responseCode = ResponseCode::DATA_EMPTY;
                        $message = "SERV: " . sprintf(ResponseMessage::DATA_EMPTY_MESSAGE,'hoá đơn');
                    }
                }
            } else {
                $responseCode = ResponseCode::ACCESS_DENIED;
                $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE . "Vui lòng đăng nhập.";
            }
        } else {
            $responseCode = ResponseCode::REQUEST_INVALID;
            $message = "SERV: " . sprintf(ResponseMessage::REQUEST_INVALID_MESSAGE); 
        }
        $this->response($responseCode,$message,$data);
    }
}
