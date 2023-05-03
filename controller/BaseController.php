<?php
class BaseController {

    public function __construct() {
        session_start();
    }
    public function renderView($view_name, $data=[]) {
        extract($data);
        $path = 'view/';
        if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){
            $path .= 'admin/';
        } else $path .= 'site/';
        include($path.$view_name.'.php');
    }

    public function getRepo($repo_name) {
        include('model/'.$repo_name.'Repository.php');
        $repo_name .= 'Repository';
        $repoObj = new $repo_name();
        return $repoObj;
    }
    public function redirect($controller, $action) {
        header("Location: ?controller=" . $controller . "&action=" . $action);
    }

    public function checkLogin()
    {
        if(!isset($_SESSION['login']) || !$_SESSION['login']) {
            $_SESSION['error_login_message'] = "Vui lòng đăng nhập để sử dụng chức năng này.";
            $this->redirect('Home', 'login_page');
        }
    }

    public function checkAdmin()
    {
        if(!isset($_SESSION['admin']) || !$_SESSION['admin']) {
            $_SESSION['error_login_message'] = "Bạn không có quyền sử dụng chức năng này.";
            $this->redirect('Home', 'index');
        }
    }

}