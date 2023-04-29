<?php 
class HomeController extends BaseController{

    public function index(){
        $feedbackRepo = $this->getRepo('feedback');
        $feedback = $feedbackRepo->getData();
        $shopRepo = $this->getRepo('shop');
        $shop = $shopRepo->getData();
        $this->renderView(
            'index',[
                'feedback' => $feedback,
                'shop' => $shop
            ]
        );
    }
    public function login_page(){
        $this->renderView('login');
    }
    public function logout(){
        $_SESSION['login'] = null;
        $_SESSION['admin'] = null;
        //echo "haha";
        $this->redirect('home','index');
    }
    public function homepage(){
        // $feedbackRepo = $this->getRepo('feedback');
        // $data = $feedbackRepo->getData();
        // return $data;
        $this->renderView('index',[]);
    }

    public function login_action(){
        $request_login = $_POST;
        $adminRepo = $this->getRepo('admin');
        $customerRepo = $this->getRepo('customer');
        $admin = $adminRepo->getByAccount($request_login['phone'], $request_login['password']);
        // var_dump($admin);
        // var_dump($admin==null);
        if ($admin == null) {
            $customer = $customerRepo->getByAccount($request_login['phone'], $request_login['password']);
            // var_dump($customer);
            // var_dump($customer==null);
            if ($customer == null) {
                $_SESSION['check_login'] = false;
                $_SESSION['msg_login'] = "Thông tin không hợp lệ.";
            } else {
                $_SESSION['login'] = true;
                $_SESSION['admin'] = false;
                $_SESSION['can_feedback'] = $customer['can_feedback'];
                $this->redirect('home','homepage');
            }
        } else {
            $_SESSION['login'] = true;
            $_SESSION['admin'] = true;
            $_SESSION['role'] = $admin['ad_role'];
            $this->redirect('home','homepage');
        }
    }
}