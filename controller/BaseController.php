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
}