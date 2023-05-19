<?php
class CustomerController extends BaseController
{

    public function customer_info()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->check_login()) {
                $this->render_view(
                    'customer_info'
                );
            }
        } else include('view/error/error-400.php');
    }

    public function data_customer_info()
    {
        $responseCode = ResponseCode::FAIL;
        $message = sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->check_login()) {
                $token = $_GET['token'] != null ? $_GET['token'] : '';
                $data = $this->verify_and_decode_token($token);
                if (!$data) {
                    $responseCode = ResponseCode::TOKEN_INVALID;
                    $message = ResponseMessage::ACCESS_DENIED_MESSAGE;
                } else {
                    $id = json_decode($data)->{'id'};
                    $role = json_decode($data)->{'role'};
                    $customerModel = $this->get_model('customer');
                    $customer = null;
                    if ($role == -1) {
                        $customer = $customerModel->get_by_id($id);
                        if ($customer != null) {
                            $responseCode = ResponseCode::SUCCESS;
                            $message = sprintf(ResponseMessage::SELECT_MESSAGE, 'người dùng', 'thành công');
                            $data = [
                                'customer' => $customer
                            ];
                        } else {
                            $responseCode = ResponseCode::OBJECT_DOES_NOT_EXIST;
                            $message = sprintf(ResponseMessage::OBJECT_DOES_NOT_EXIST_MESSAGE, 'người dùng');
                        }
                    } else {
                        $responseCode = ResponseCode::ACCESS_DENIED;
                        $message = ResponseMessage::ACCESS_DENIED_MESSAGE;
                    }
                }
            } else {
                $responseCode = ResponseCode::ACCESS_DENIED;
                $message = ResponseMessage::ACCESS_DENIED_MESSAGE;
            }
        } else {
            $responseCode = ResponseCode::REQUEST_INVALID;
            $message = sprintf(ResponseMessage::REQUEST_INVALID_MESSAGE);
        }
        $this->response($responseCode, $message, $data);
    }

    public function register()
    {
        $responseCode = ResponseCode::FAIL;
        $message = sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $customerModel = $this->get_model('customer');
            if (isset($_POST['rgName']) && $_POST['rgName'] != '' && isset($_POST['rgPhone']) && $_POST['rgPhone'] != '' && isset($_POST['rgAddress']) && $_POST['rgAddress'] != '' && isset($_POST['rgPassword']) && $_POST['rgPassword'] != '' && isset($_POST['rgGender']) && $_POST['rgGender'] != '') {
                $customerInfo = $_POST;
                if (strlen($customerInfo['rgName']) >= 2) {
                    if (strlen($customerInfo['rgPhone']) >= 10 && strlen($customerInfo['rgPhone']) <= 13 && $this->checkChars($customerInfo['rgPhone'], true, false, false, false, false, false, 0)) {
                        if ($this->checkChars($customerInfo['rgPassword'], true, true, true, true, true, 8)) {
                            $cus0 = $customerModel->get_by_phone($customerInfo['rgPhone'], 0);
                            $cus1 = $customerModel->get_by_phone($customerInfo['rgPhone'], 1);
                            if ($cus0 == null && $cus1 == null) {
                                $dataRegister = [
                                    'name' => $customerInfo['rgName'],
                                    //'email' => $_POST['rgEmail'],
                                    'phone' => $customerInfo['rgPhone'],
                                    'address' => $customerInfo['rgAddress'],
                                    'password' => $customerInfo['rgPassword'],
                                    'gender' => $customerInfo['rgGender'],
                                    'active' => 1
                                ];
                                if ($customerModel->save_data($dataRegister)) {
                                    $responseCode = ResponseCode::SUCCESS;
                                    $message = sprintf(ResponseMessage::INSERT_MESSAGE, 'người dùng', 'thành công');
                                } else {
                                    $responseCode = ResponseCode::FAIL;
                                    $message = sprintf(ResponseMessage::INSERT_MESSAGE, 'người dùng', 'thất bại');
                                }
                            } else if ($cus1 != null) {
                                //$responseCode = "2";
                                //$data[] = 2;
                                $responseCode = ResponseCode::OBJECT_EXISTS;
                                $message = sprintf(ResponseMessage::OBJECT_EXISTS_MESSAGE, 'Thông tin người dùng');
                            } else if ($cus0 != null) {
                                //$data[] = 3;
                                $dataRegister = [
                                    //'ctm_name' => $_POST['rgName'],
                                    //'ctm_email' => $_POST['rgEmail'],
                                    'ctm_phone' => $customerInfo['rgPhone'],
                                    'ctm_address' => $customerInfo['rgAddress'],
                                    'ctm_password' => $customerInfo['rgPassword'],
                                    //'ctm_gender' => $_POST['rgGender'],
                                    'ctm_active' => 1
                                ];
                                if ($customerModel->update_data($dataRegister, $cus0['ctm_id'])) {
                                    $responseCode = ResponseCode::SUCCESS;
                                    $message = sprintf(ResponseMessage::UPDATE_MESSAGE, 'người dùng', 'thành công');
                                } else {
                                    $responseCode = ResponseCode::FAIL;
                                    $message = sprintf(ResponseMessage::UPDATE_MESSAGE, 'người dùng', 'thất bại');
                                }
                            } 
                        } else {
                            $responseCode = ResponseCode::INPUT_INVALID_TYPE;
                            $message = "Mật khẩu phải bao gồm chữ cái hoa, chữ cái thường, số, ít nhất 1 ký tự đặc biệt và có độ dài tối thiểu 8 ký tự."; 
                        }
                    } else {
                        $responseCode = ResponseCode::INPUT_INVALID_TYPE;
                        $message = sprintf(ResponseMessage::INPUT_INVALID_TYPE_MESSAGE,'số điện thoại');  
                    }
                } else {
                    $responseCode = ResponseCode::INPUT_INVALID_TYPE;
                    $message = "Tên người dùng tối thiểu 2 ký tự.";      
                }
            } else {
                $responseCode = ResponseCode::INPUT_EMPTY;
                $message = sprintf(ResponseMessage::INPUT_EMPTY_MESSAGE,'đăng ký');          
            }
        } else {
            $responseCode = ResponseCode::REQUEST_INVALID;
            $message = sprintf(ResponseMessage::REQUEST_INVALID_MESSAGE);
        }
        $this->response($responseCode, $message, $data);
    }
}
