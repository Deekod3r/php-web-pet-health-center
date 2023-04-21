<?php 
class HomeController extends BaseController{

    public function index(){
        $this->renderView(
            'index',[]
        );
    }
    public function login_page(){
        $this->renderView('login');
    }

    public function login_action(){
        $request_login = $_POST;
        $adminRepo = $this->getRepo('admin');
        $customerRepo = $this->getRepo('customer');
        $admin = $adminRepo->getByAccount($request_login['phone'], $request_login['password'])->getData_response();
        if ($admin == null) {
            $customer = $customerRepo->getByAccount($request_login['phone'], $request_login['password'])->getData_response();
            if ($customer == null) {
                $_SESSION['check_login'] = false;
                $_SESSION['msg_login'] = "Thông tin không hợp lệ.";
            } else {
                $_SESSION['login'] = true;
                $_SESSION['admin'] = false;
                $_SESSION['can_feedback'] = $customer['can_feedback'];
                $this->renderView('index',[]);
            }
        }
    }
}