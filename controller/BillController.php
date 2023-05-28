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
                    'bill/bill'
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

    public function data_bill()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = $_GET;
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
                //        $admin = $adminModel->get_by_id($id);
                // if ($role == Enum::ROLE_MANAGER && $role == $admin['ad_role']) {
                $key = "";
                $limit = 0;
                $offset = 0;
                if (isset($_GET['billId']) and $_GET['billId'] != '') {
                    $key .= " bill_id = " . $_GET['billId'];
                }
                if (isset($_GET['ctmPhone']) and $_GET['ctmPhone'] != '') {
                    if ($key != '') $key = $key . " and ";
                    $key .= " ctm_phone = '" . $_GET['ctmPhone'] . "'";
                }
                if (isset($_GET['billYear']) and $_GET['billYear'] != '') {
                    if ($key != '') $key = $key . " and ";
                    $key .= " year(bill_date_release) = " . $_GET['billYear'];
                }
                if (isset($_GET['billMonth']) and $_GET['billMonth'] != '') {
                    if ($key != '') $key = $key . " and ";
                    $key .= " month(bill_date_release) = " . $_GET['billMonth'];
                }
                if (isset($_GET['billDate']) and $_GET['billDate'] != '') {
                    if ($key != '') $key = $key . " and ";
                    $key .= " date(bill_date_release) = '" . $_GET['billDate'] . "'";
                }
                if (isset($_GET['billStatus']) and $_GET['billStatus'] != '') {
                    if ($key != '') $key = $key . " and ";
                    $key .= " bill_status = " . $_GET['billStatus'];
                }
                if ($key != '') $key = "where " . $key;
                $billModel = $this->get_model('bill');
                $count = $billModel->count_data($key);
                if ($count > 0) {
                    $key .= " order by bill_status, bill_date_release DESC ";
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
                    $bills = $billModel->get_data($key);
                    if ($bills != null) {
                        $responseCode = ResponseCode::SUCCESS;
                        $message = "SERV: " . sprintf(ResponseMessage::SELECT_MESSAGE, 'hoá đơn', 'thành công');
                        $data = [
                            'bills' => $bills,
                            'count' => $count                        
                        ];
                    } else {
                        $responseCode = ResponseCode::OBJECT_DOES_NOT_EXIST;
                        $message = "SERV: " . sprintf(ResponseMessage::OBJECT_DOES_NOT_EXIST_MESSAGE, 'hoá đơn');
                    }
                } else {
                    $responseCode = ResponseCode::DATA_EMPTY;
                    $message = "SERV: " . sprintf(ResponseMessage::DATA_EMPTY_MESSAGE, "hoá đơn");
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

    public function add_bill()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = $_POST;
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($this->check_admin() && ($this->check_admin_role(Enum::ROLE_MANAGER) || $this->check_admin_role(Enum::ROLE_SALE))) {
                    $token = isset($_POST['token']) && $_POST['token'] != null ? $_POST['token'] : '';
                    $dataToken = $this->verify_and_decode_token($token);
                    if (!$dataToken) {
                        $responseCode = ResponseCode::TOKEN_INVALID;
                        $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE . " token:" . $token;
                    } else {
                        if (isset($_POST['ctmPhone']) && $_POST['ctmPhone'] != '') {
                            //&& isset($_FILES["svImg"]) && !$_FILES["svImg"]["name"] != ''
                            $id = json_decode($dataToken)->{'id'};
                            $admin = $this->get_model('admin')->get_by_id($id);
                            if ($admin != null) {
                                if ($admin['ad_role'] == Enum::ROLE_MANAGER || $admin['ad_role'] == Enum::ROLE_SALE) {
                                    $customerModel = $this->get_model('customer');
                                    $customer = $customerModel->get_data("where ctm_phone = '" . $_POST['ctmPhone'] . "'");
                                    if ($customer != null) {
                                        $billModel = $this->get_model('bill');
                                        $databill = [
                                            'ctm' => $customer[0]['ctm_id'],
                                            'ad' => $id
                                        ];
                                        if ($billModel->save_data($databill)) {
                                            $responseCode = ResponseCode::SUCCESS;
                                            $message = "SERV: " . sprintf(ResponseMessage::INSERT_MESSAGE, "hoá đơn", "thành công");
                                        } else {
                                            $message = "SERV: " . sprintf(ResponseMessage::INSERT_MESSAGE, "hoá đơn", "thất bại");
                                        }
                                    } else {
                                        $responseCode = ResponseCode::OBJECT_DOES_NOT_EXIST;
                                        $message = "SERV: " . sprintf(ResponseMessage::OBJECT_DOES_NOT_EXIST_MESSAGE, "Khách hàng");
                                    }
                                } else {
                                    $responseCode = ResponseCode::ACCESS_DENIED;
                                    $message = "SERV1: " . ResponseMessage::ACCESS_DENIED_MESSAGE;
                                }
                            } else {
                                $responseCode = ResponseCode::OBJECT_DOES_NOT_EXIST;
                                $message = "SERV: " . sprintf(ResponseMessage::OBJECT_DOES_NOT_EXIST_MESSAGE, 'admin');
                            }
                        } else {
                            $responseCode = ResponseCode::INPUT_EMPTY;
                            $message = "SERV: " . sprintf(ResponseMessage::INPUT_EMPTY_MESSAGE, "hoá đơn");
                        }
                    }
                } else {
                    $responseCode = ResponseCode::ACCESS_DENIED;
                    $message = "SERV2: " . ResponseMessage::ACCESS_DENIED_MESSAGE;
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
}
