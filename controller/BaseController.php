<?php
class BaseController
{

    public function __construct()
    {
        session_start();
    }
    public function renderView($view_name, $data = [])
    {
        extract($data);
        $path = 'view/';
        if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
            $path .= 'admin/';
        } else $path .= 'site/';
        include($path . $view_name . '.php');
    }

    public function getRepo($repo_name)
    {
        include('model/' . $repo_name . 'Repository.php');
        $repo_name .= 'Repository';
        $repoObj = new $repo_name();
        return $repoObj;
    }
    public function redirect($controller, $action)
    {
        header("Location: ?controller=" . $controller . "&action=" . $action);
    }

    public function checkLogin()
    {
        if (!isset($_SESSION['login']) || !$_SESSION['login']) {
            include('view/error/error-403.php');
            return false;
        } else return true;
    }

    public function checkAdmin()
    {
        if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
            include('view/error/error-403.php');
            return false;
        } else return true;
    }
}
