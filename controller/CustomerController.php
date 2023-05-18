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
        $message = sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE,"");
        $data[] = null;
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->check_login()) {
                $token = $_GET['token'] != null ? $_GET['token'] : '';;
                $data = $this->verify_and_decode_token($token);
                if (!$data) {
                    $this->redirect( 'home','index' );
                } else {
                    $id = json_decode($data)->{'id'};                   
                    $customerModel = $this->get_model('customer');
                    $customer = $customerModel->get_by_id($id);
                    $result = [
                        "statusCode" => "1",
                        "message" => "OK",
                        "data" => [
                            'customer' => $customer
                        ]
                    ];
                    echo json_encode($result);
                }
            } else $this->redirect( 'home','index' );
        }  else {
            $responseCode = ResponseCode::REQUEST_INVALID;
            $message = sprintf(ResponseMessage::REQUEST_INVALID_MESSAGE); 
        }
        $this->response($responseCode,$message,$data);
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['rgName'],
                'email' => $_POST['rgEmail'],
                'phone' => $_POST['rgPhone'],
                'address' => $_POST['rgAddress'],
                'password' => $_POST['rgPassword'],
                'gender' => $_POST['rgGender']
            ];
            $customerModel = $this->get_model('customer');
            if ($customerModel->save_data($data)) {
                $_SESSION['msg_register'] = "Đăng ký thành công.";
                $_SESSION['check_register'] = true;
            } else {
                $_SESSION['msg_register'] = "Đăng ký không thành công.";
                $_SESSION['check_register'] = false;
            }
            $this->redirect('home', 'login_page');
        } else include('view/error/error-400.php');
    }
}
