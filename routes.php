<?php
include('controller/BaseController.php');
include('model/BaseRepository.php');
include('config/Enum/Enum.php');
if (isset($_GET['controller']) && isset($_GET['action'])) {
    //echo $_GET['controller']. " " . $_GET['action'];
    $controller = $_GET['controller'];
    $action = $_GET['action'];
    $controllerFileName = 'controller/' . $controller . 'Controller.php';
    if (file_exists($controllerFileName)) {
        include($controllerFileName);
        $controllerClass = $controller . 'Controller';
        $controllerObj = new $controllerClass();
        if (method_exists($controllerObj, $action)) {
            $controllerObj->$action();
        } else {
            include('view/error/error-404.php');
        }
    } else {
        include('view/error/error-404.php');
    }
} else {
    header("location:routes.php?controller=home&action=index");
}
