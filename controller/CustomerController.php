<?php
class CustomerController extends BaseController
{

    public function customer_info()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->check_login()) {
                $this->render_view(
                    'customer-info'
                );
            } else $this->render_error('403');
        } else $this->render_error('400');
    }
    public function customer_page_ad()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->check_admin() && ($this->check_admin_role(Enum::ROLE_MANAGER) || $this->check_admin_role(Enum::ROLE_SALE))) {
                $this->render_view(
                    'customer'
                );
            } else $this->render_error('403');
        } else $this->render_error('400');
    }
    public function data_customer_info()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                if ($this->check_login()) {
                    $token = $_GET['token'] != null ? $_GET['token'] : '';
                    $data = $this->verify_and_decode_token($token);
                    if (!$data) {
                        $responseCode = ResponseCode::TOKEN_INVALID;
                        $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE;
                    } else {
                        $id = json_decode($data)->{'id'};
                        $role = json_decode($data)->{'role'};
                        $customerModel = $this->get_model('customer');
                        $customer = null;
                        if ($role == -1) {
                            $customer = $customerModel->get_by_id($id);
                            if ($customer != null) {
                                $responseCode = ResponseCode::SUCCESS;
                                $message = "SERV: " . sprintf(ResponseMessage::SELECT_MESSAGE, 'người dùng', 'thành công');
                                $data = [
                                    'customer' => $customer
                                ];
                            } else {
                                $responseCode = ResponseCode::OBJECT_DOES_NOT_EXIST;
                                $message = "SERV: " . sprintf(ResponseMessage::OBJECT_DOES_NOT_EXIST_MESSAGE, 'người dùng');
                            }
                        } else {
                            $responseCode = ResponseCode::ACCESS_DENIED;
                            $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE;
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
        } catch (Exception $e) {
            $responseCode = ResponseCode::UNKNOWN_ERROR;
            $message = "SERV: " . $e->getMessage();
        }
        $this->response($responseCode, $message, $data);
    }

    public function register()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $customerModel = $this->get_model('customer');
                if (isset($_POST['rgName']) && $_POST['rgName'] != '' && isset($_POST['rgPhone']) && $_POST['rgPhone'] != '' && isset($_POST['rgAddress']) && $_POST['rgAddress'] != '' && isset($_POST['rgPassword']) && $_POST['rgPassword'] != '' && isset($_POST['rgGender']) && $_POST['rgGender'] != '') {
                    $customerInfo = $_POST;
                    if (strlen($customerInfo['rgName']) >= 2) {
                        if (strlen($customerInfo['rgPhone']) >= 10 && strlen($customerInfo['rgPhone']) <= 13 && !preg_match($this->specialChars, $customerInfo['rgPhone']) && !preg_match($this->upperChars, $customerInfo['rgPhone']) && !preg_match($this->lowerChars, $customerInfo['rgPhone'])) {
                            if (strlen($customerInfo['rgPassword']) >= 8 && preg_match($this->number, $customerInfo['rgPassword']) && preg_match($this->lowerChars, $customerInfo['rgPassword']) && preg_match($this->upperChars, $customerInfo['rgPassword']) && preg_match($this->specialChars, $customerInfo['rgPassword'])) {
                                $cus0 = $customerModel->get_by_phone($customerInfo['rgPhone'], 0);
                                $cus1 = $customerModel->get_by_phone($customerInfo['rgPhone'], 1);
                                if ($cus0 == null && $cus1 == null) {
                                    $data[] = 1;
                                    $dataRegister = [
                                        'name' => trim($customerInfo['rgName']),
                                        //'email' => $_POST['rgEmail'],
                                        'phone' => trim($customerInfo['rgPhone']),
                                        'address' => trim($customerInfo['rgAddress']),
                                        'password' => md5($customerInfo['rgPassword']),
                                        'gender' => $customerInfo['rgGender'],
                                        'active' => 1
                                    ];
                                    if ($customerModel->save_data($dataRegister)) {
                                        $responseCode = ResponseCode::SUCCESS;
                                        $message = "SERV: " . sprintf(ResponseMessage::INSERT_MESSAGE, 'người dùng', 'thành công');
                                    } else {
                                        $responseCode = ResponseCode::FAIL;
                                        $message = "SERV: " . sprintf(ResponseMessage::INSERT_MESSAGE, 'người dùng', 'thất bại');
                                    }
                                } else if ($cus1 != null) {
                                    //$responseCode = "2";
                                    //$data[] = $cus1;
                                    $responseCode = ResponseCode::OBJECT_EXISTS;
                                    $message = "SERV: " . sprintf(ResponseMessage::OBJECT_EXISTS_MESSAGE, 'Thông tin người dùng');
                                } else if ($cus0 != null) {
                                    //$data[] = 3;
                                    $dataRegister = [
                                        //'ctm_name' => $_POST['rgName'],
                                        //'ctm_email' => $_POST['rgEmail'],
                                        'ctm_phone' => trim($customerInfo['rgPhone']),
                                        'ctm_address' => trim($customerInfo['rgAddress']),
                                        'ctm_password' => md5($customerInfo['rgPassword']),
                                        //'ctm_gender' => $_POST['rgGender'],
                                        'ctm_active' => 1
                                    ];
                                    if ($customerModel->update_data($dataRegister, $cus0['ctm_id'])) {
                                        $responseCode = ResponseCode::SUCCESS;
                                        $message = "SERV: " . sprintf(ResponseMessage::UPDATE_MESSAGE, 'người dùng', 'thành công');
                                    } else {
                                        $responseCode = ResponseCode::FAIL;
                                        $message = "SERV: " . sprintf(ResponseMessage::UPDATE_MESSAGE, 'người dùng', 'thất bại');
                                    }
                                }
                            } else {
                                $responseCode = ResponseCode::INPUT_INVALID_TYPE;
                                $message = "SERV: " . "Mật khẩu phải bao gồm chữ cái hoa-thường-số, ít nhất 1 ký tự đặc biệt và độ dài tối thiểu 8 ký tự.";
                            }
                        } else {
                            $responseCode = ResponseCode::INPUT_INVALID_TYPE;
                            $message = "SERV: " . sprintf(ResponseMessage::INPUT_INVALID_TYPE_MESSAGE, 'số điện thoại');
                        }
                    } else {
                        $responseCode = ResponseCode::INPUT_INVALID_TYPE;
                        $message = "SERV: " . "Tên người dùng tối thiểu 2 ký tự.";
                    }
                } else {
                    $responseCode = ResponseCode::INPUT_EMPTY;
                    $message = "SERV: " . sprintf(ResponseMessage::INPUT_EMPTY_MESSAGE, 'đăng ký');
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

    public function check_can_feedback()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                if ($this->check_login()) {
                    $token = $_GET['token'] != null ? $_GET['token'] : '';
                    $data = $this->verify_and_decode_token($token);
                    if (!$data) {
                        $responseCode = ResponseCode::TOKEN_INVALID;
                        $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE;
                    } else {
                        $id = json_decode($data)->{'id'};
                        $role = json_decode($data)->{'role'};
                        $customerModel = $this->get_model('customer');
                        $customer = null;
                        if ($role == -1) {
                            $customer = $customerModel->get_by_id($id);
                            if ($customer != null) {
                                $responseCode = ResponseCode::SUCCESS;
                                $message = "SERV: " . sprintf(ResponseMessage::SELECT_MESSAGE, 'người dùng', 'thành công');
                                $data = [
                                    'ctmId' => $customer['ctm_id'],
                                    'canFeedback' => $customer['ctm_can_feedback']
                                ];
                            } else {
                                $responseCode = ResponseCode::OBJECT_DOES_NOT_EXIST;
                                $message = "SERV: " . sprintf(ResponseMessage::OBJECT_DOES_NOT_EXIST_MESSAGE, 'người dùng');
                            }
                        } else {
                            $responseCode = ResponseCode::ACCESS_DENIED;
                            $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE;
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
        } catch (Exception $e) {
            $responseCode = ResponseCode::UNKNOWN_ERROR;
            $message = "SERV: " . $e->getMessage();
        }
        $this->response($responseCode, $message, $data);
    }

    public function data_customer()
    {
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
                //        $admin = $adminModel->get_by_id($id);
                // if ($role == Enum::ROLE_MANAGER && $role == $admin['ad_role']) {
                $key = '';
                $limit = 0;
                $offset = 0;
                if (isset($_GET['ctmName']) and $_GET['ctmName'] != '') {
                    $key .= "ctm_name like '%" . htmlspecialchars($_GET['ctmName']) . "%'";
                }
                if (isset($_GET['ctmPhone']) and $_GET['ctmPhone'] != '') {
                    if ($key != '') {
                        $key .= ' and ';
                    }
                    $key .= "ctm_phone like '%" . htmlspecialchars($_GET['ctmPhone']) . "%'";
                }
                if (isset($_GET['ctmAddress']) and $_GET['ctmAddress'] != '') {
                    if ($key != '') {
                        $key .= ' and ';
                    }
                    $key .= "ctm_address like '%" . htmlspecialchars($_GET['ctmAddress']) . "%'";
                }
                if (isset($_GET['ctmId']) and $_GET['ctmId'] != '') {
                    if ($key != '') {
                        $key .= ' and ';
                    }
                    $key .= "ctm_id = " . $_GET['ctmId'];
                }
                if (isset($_GET['ctmActive']) and $_GET['ctmActive'] != '') {
                    if ($key != '') {
                        $key .= ' and ';
                    }
                    $key .= " ctm_active = " . $_GET['ctmActive'];
                }

                if ($key != '') $key = "where " . $key;
                // $message = "SERV: " . $key;
                // $data = $_GET;
                $customerModel = $this->get_model('customer');
                $count = $customerModel->count_data($key);
                if ($count > 0) {
                    if (isset($_GET['limit']) and $_GET['limit'] != '') {
                        $key .= " order by ctm_active DESC ";
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
                    $customers = $customerModel->get_data($key);
                    if ($customers != null) {
                        $responseCode = ResponseCode::SUCCESS;
                        $message = "SERV: " . sprintf(ResponseMessage::SELECT_MESSAGE, 'khách hàng', 'thành công');
                        $data = [
                            'customers' => $customers,
                            'count' => $count
                        ];
                    } else {
                        $responseCode = ResponseCode::OBJECT_DOES_NOT_EXIST;
                        $message = "SERV: " . sprintf(ResponseMessage::OBJECT_DOES_NOT_EXIST_MESSAGE, 'khách hàng');
                    }
                } else {
                    $responseCode = ResponseCode::DATA_EMPTY;
                    $message = "SERV: " . sprintf(ResponseMessage::DATA_EMPTY_MESSAGE, "khách hàng");
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

    public function add_customer()
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
                        if (isset($_POST['ctmName']) && $_POST['ctmName'] != '' && isset($_POST['ctmAddress']) && $_POST['ctmAddress'] != '' && isset($_POST['ctmPhone']) && $_POST['ctmPhone'] != '' && isset($_POST['ctmGender']) && $_POST['ctmGender'] != '') {
                            $id = json_decode($dataToken)->{'id'};
                            $admin = $this->get_model('admin')->get_by_id($id);
                            if ($admin != null) {
                                if ($admin['ad_role'] == Enum::ROLE_MANAGER || $admin['ad_role'] == Enum::ROLE_SALE) {
                                    $customerModel = $this->get_model('customer');
                                    $cus = $customerModel->get_data("where ctm_phone = '" . $_POST['ctmPhone'] ."'");
                                    if ($cus == null) {
                                        $dataCustomer = [
                                            'name' => $_POST['ctmName'],
                                            'address' => $_POST['ctmAddress'],
                                            'phone' => $_POST['ctmPhone'],
                                            'password' => '',
                                            'gender' => $_POST['ctmGender'],
                                            'active' => 0
                                        ];
                                        if ($customerModel->save_data($dataCustomer)) {
                                            $responseCode = ResponseCode::SUCCESS;
                                            $message = "SERV: " . sprintf(ResponseMessage::INSERT_MESSAGE, "khách hàng", "thành công");
                                        } else {
                                            $message = "SERV: " . sprintf(ResponseMessage::INSERT_MESSAGE, "khách hàng", "thất bại");
                                        }
                                    } else {
                                        $responseCode = ResponseCode::OBJECT_EXISTS;
                                        $message = "SERV: " . sprintf(ResponseMessage::OBJECT_EXISTS_MESSAGE, 'Thông tin người dùng');
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
                            $message = "SERV: " . sprintf(ResponseMessage::INPUT_EMPTY_MESSAGE, "khách hàng");
                        }
                    }
                } else {
                    $responseCode = ResponseCode::ACCESS_DENIED;
                    $message = "SERV2: " . ResponseMessage::ACCESS_DENIED_MESSAGE . " 1" . $this->check_admin_role(Enum::ROLE_MANAGER) . " 2" . $this->check_admin() . " 3" . $this->check_login();
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
