<?php
class CustomerController extends BaseController
{

    public function customer_info()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->checkLogin()) {
                $this->renderView(
                    'customer_info'
                );
            }
        } else include('view/error/error-400.php');
    }

    public function data_customer_info()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->checkLogin()) {
                $token = $_GET['token'];
                $data = $this->verify_and_decode_token($token);
                if (!$data) {
                    $this->redirect( 'home','index' );
                } else {
                    $id = json_decode($data)->{'id'};                   
                    $customerRepo = $this->getRepo('customer');
                    $customer = $customerRepo->getById($id);
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
        } else include('view/error/error-400.php');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['rg-name'],
                'email' => $_POST['rg-email'],
                'phone' => $_POST['rg-phone'],
                'address' => $_POST['rg-address'],
                'password' => $_POST['rg-password'],
                'gender' => $_POST['rg-gender']
            ];
            $customerRepo = $this->getRepo('customer');
            if ($customerRepo->saveData($data)) {
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
