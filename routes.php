<?php
// include('controllers/BaseController.php');
// include('controllers/AdminController.php');
// include('models/BaseModel.php');

if(isset($_GET['controller']) && $_GET['action']) {
    $controller = $_GET['controller'];
    $action = $_GET['action'];
    $controllerFileName = $controller.'Controller.php';
    $controllerFileName = 'controllers/'.$controllerFileName;
    if(file_exists($controllerFileName)) {
        include($controllerFileName);
        $controllerClass = $controller.'Controller';
        $controllerObj = new $controllerClass();
        $controllerObj->$action();
    }else {
        include('views/404-notfound.php');
    }
}