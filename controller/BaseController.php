<?php
class BaseController {

    public function renderView($view_name, $data=[]) {
        extract($data);
        include('views/'.$view_name.'.php');
    }

    public function getModel($model_name) {
        include('models/'.$model_name.'.php');
        $modelObj = new $model_name();
        return $modelObj;
    }
    public function redirect($controller, $action) {
        header("Location: ?controller=" . $controller . "&action=" . $action);
    }

    public function __construct()
    {
        session_start();
        if(!isset($_SESSION['is_login'])) {
            $_SESSION['error_login_message'] = "Vui lòng đăng nhập để sử dụng này.";
            $this->redirect('Home', 'login_page');
        }
    }
}