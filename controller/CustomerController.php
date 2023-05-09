<?php
class CustomerController extends BaseController
{

    public function customer_info()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->checkLogin()) {
                $shopRepo = $this->getRepo('shop');
                $shop = $shopRepo->getData("");
                $customerRepo = $this->getRepo('customer');
                $customer = $customerRepo->getById($_SESSION['id']);
                $this->renderView(
                    'customer_info',
                    [
                        'shop' => $shop,
                        'customer' => $customer
                    ]
                );
            }
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
