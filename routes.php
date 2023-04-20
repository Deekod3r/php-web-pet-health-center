<?php
include('controller/BaseController.php');
if(isset($_GET['controller']) && isset($_GET['action'])) {
    //echo $_GET['controller']. " " . $_GET['action'];
    $controller = $_GET['controller'];
    $action = $_GET['action'];
    $controllerFileName ='controller/'.$controller.'Controller.php';
    if(file_exists($controllerFileName)) {
        include($controllerFileName);
        $controllerClass = $controller.'Controller';
        $controllerObj = new $controllerClass();
        $controllerObj->$action();
    }else {
        include('view/error/error.php');
    }
} else {
    header("location:routes.php?controller=home&action=index");
}