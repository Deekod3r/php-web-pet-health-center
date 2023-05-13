<?php
class HomeController extends BaseController
{

    public function index()
    {
        $feedbackRepo = $this->getRepo('feedback');
        $feedback = $feedbackRepo->getData("");
        $shopRepo = $this->getRepo('shop');
        $shop = $shopRepo->getData("");
        $this->renderView(
            'index',
            [
                'feedback' => $feedback,
                'shop' => $shop
            ]
        );
    }
    public function login_page()
    {
        if (isset($_SESSION['login']) && $_SESSION['login']) {
            $this->redirect('home', 'index');
        } else  $this->renderView('login');
    }
    public function logout()
    {
        $_SESSION['login'] = null;
        $_SESSION['admin'] = null;
        $_SESSION['can_feedback'] = null;
        $_SESSION['role'] = null;
        $_SESSION['id'] = null;
        //echo "haha";
        $this->redirect('home', 'index');
    }

    public function login_action()
    {
        $request_login = $_POST;
        //var_dump($request_login);
        //var_dump($data);
        $adminRepo = $this->getRepo('admin');
        $customerRepo = $this->getRepo('customer');
        $admin = $adminRepo->getByAccount(htmlspecialchars($request_login['lg-phone']), htmlspecialchars($request_login['lg-password']));
        // var_dump($admin);
        // var_dump($admin==null);
        if ($admin == null) {
            $customer = $customerRepo->getByAccount(htmlspecialchars($request_login['lg-phone']), htmlspecialchars($request_login['lg-password']));
            // var_dump($customer);
            // var_dump($customer==null);
            if ($customer == null) {
                $_SESSION['check_login'] = false;
                $_SESSION['msg_login'] = "Thông tin không hợp lệ.";
                //$this->redirect('home', 'login_page');
                //return false;
                $result = ["checkLogin" => false];
                echo json_encode($result);
                //echo "false";
            } else {
                $_SESSION['login'] = true;
                $_SESSION['admin'] = false;
                $_SESSION['can_feedback'] = $customer['ctm_can_feedback'];
                $_SESSION['id'] = $customer['ctm_id'];
                //$this->redirect('home', 'index');
                //return true;
                $result = ["checkLogin" => true];
                echo json_encode($result);
                //echo "true";
            }
        } else {
            $_SESSION['login'] = true;
            $_SESSION['admin'] = true;
            $_SESSION['role'] = $admin['ad_role'];
            $_SESSION['id'] = $admin['ad_id'];
            //$this->redirect('home', 'index');
            //return true;
            $result = ["checkLogin" => true];
            echo json_encode($result);
            //echo "true";
        }
    }
}
