<?php
class BaseController {

    public function renderView($view_name, $data=[]) {
        extract($data);
        $path = 'view/';
        if(isset($_SESSION["admin"]) && $_SESSION["admin"]){
            $path .= 'admin/';
        } else $path .= 'site/';
        include($path.$view_name.'.php');
    }

    public function getRepo($repo_name) {
        include('repository/'.$repo_name.'Repository.php');
        $repoObj = new $repo_name();
        return $repoObj;
    }
    public function redirect($controller, $action) {
        header("Location: ?controller=" . $controller . "&action=" . $action);
    }

    // public function __construct()
    // {
    //     session_start();
    //     if(!isset($_SESSION['is_login'])) {
    //         $_SESSION['error_login_message'] = "Vui lòng đăng nhập để sử dụng này.";
    //         $this->redirect('Home', 'login_page');
    //     }
    // }
}