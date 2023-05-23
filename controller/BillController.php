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
            } else $this->render_error('403');
        } else $this->render_error('400');
    }
    public function bill_page_ad()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->check_admin() && ($this->check_admin_role(Enum::ROLE_MANAGER) || $this->check_admin_role(Enum::ROLE_SALE))) {
                $this->render_view(
                    'bill'
                );
            } else $this->render_error('403');
        } else $this->render_error('400');
    }
    public function data_customer_history()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        try {
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
                            $bills = $billModel->get_data(" where ctm_id = $id " . $key);
                            $responseCode = ResponseCode::SUCCESS;
                            $message = "SERV: " . sprintf(ResponseMessage::SELECT_MESSAGE, 'hoá đơn', 'thành công');
                            //$message = "SERV: " . " where ctm_id = $id " . $key;
                            $data = [
                                'bills' => $bills,
                                'count' => $count
                            ];
                        } else {
                            $responseCode = ResponseCode::DATA_EMPTY;
                            $message = "SERV: " . sprintf(ResponseMessage::DATA_EMPTY_MESSAGE, 'hoá đơn');
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
        } catch (Exception $e) {
            $responseCode = ResponseCode::UNKNOWN_ERROR;
            $message = "SERV: " . $e->getMessage();
        }
        $this->response($responseCode, $message, $data);
    }

    public function data_detail_bill()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                if ($this->check_login()) {
                    $token = isset($_GET['token']) ? $_GET['token'] : '';
                    $dataToken = $this->verify_and_decode_token($token);
                    if (!$dataToken) {
                        $responseCode = ResponseCode::TOKEN_INVALID;
                        $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE;
                    } else {
                        $idCtm = json_decode($dataToken)->{'id'};
                        $idBill = $_GET['idBill'];
                        $billModel = $this->get_model('bill');
                        $check = $billModel->check_bill($idBill, $idCtm);
                        if ($check) {
                            $detailBillModel = $this->get_model('detailbill');
                            $count = $detailBillModel->count_data_by_bill($idBill);
                            if ($count > 0) {
                                $detailBill = $detailBillModel->get_by_bill($idBill);
                                $responseCode = ResponseCode::SUCCESS;
                                $message = "SERV: " . sprintf(ResponseMessage::SELECT_MESSAGE, 'chi tiết hoá đơn', 'thành công');
                                //$message = "SERV: " . " where ctm_id = $id " . $key;
                                $data = [
                                    'detailBill' => $detailBill
                                ];
                            } else {
                                $responseCode = ResponseCode::DATA_EMPTY;
                                $message = "SERV: " . sprintf(ResponseMessage::DATA_EMPTY_MESSAGE, 'chi tiết hoá đơn');
                            }
                        } else {
                            $responseCode = ResponseCode::OBJECT_DOES_NOT_EXIST;
                            $message = "SERV: " . sprintf(ResponseMessage::OBJECT_DOES_NOT_EXIST_MESSAGE, 'Thông tin hoá đơn');
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
        } catch (Exception $e) {
            $responseCode = ResponseCode::UNKNOWN_ERROR;
            $message = "SERV: " . $e->getMessage();
        }
        $this->response($responseCode, $message, $data);
    }

    public function data_bill(){
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                // if ($this->check_admin() && $this->check_admin_role(Enum::ROLE_MANAGER)) {
                //     $token = $_GET['token'] != null ? $_GET['token'] : '';
                //     $data = $this->verify_and_decode_token($token);
                //     if (!$data) {
                //         $responseCode = ResponseCode::TOKEN_INVALID;
                //         $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE;
                //     } else {
                //         $id = json_decode($data)->{'id'};
                //         $role = json_decode($data)->{'role'};
                        $billModel = $this->get_model('bill');
                //        $admin = $adminModel->get_by_id($id);
                        // if ($role == Enum::ROLE_MANAGER && $role == $admin['ad_role']) {
                            $bills = $billModel->get_data(" order by bill_date_release DESC");
                            if ($bills != null) {
                                $responseCode = ResponseCode::SUCCESS;
                                $message = "SERV: " . sprintf(ResponseMessage::SELECT_MESSAGE, 'hoá đơn', 'thành công');
                                $data = [
                                    'bills' => $bills
                                ];
                            } else {
                                $responseCode = ResponseCode::OBJECT_DOES_NOT_EXIST;
                                $message = "SERV: " . sprintf(ResponseMessage::OBJECT_DOES_NOT_EXIST_MESSAGE, 'hoá đơn');
                            }
                //         } else {
                //             $responseCode = ResponseCode::ACCESS_DENIED;
                //             $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE;
                //         }
                //     }
                // } else {
                //     $responseCode = ResponseCode::ACCESS_DENIED;
                //     $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE;
                // }
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
}
