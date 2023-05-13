<?php
class BaseController
{

    public function __construct()
    {
        session_start();
    }

    public function renderView($view_name)
    {
        $path = 'view/';
        if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
            $path .= 'admin/';
        } else $path .= 'site/';
        include($path . $view_name . '.php');
    }

    public function renderViewRole($view_name, $role)
    {
        $path = 'view/';
        if ($role == 'admin') {
            $path .= 'admin/';
        } else $path .= 'site/';
        include($path . $view_name . '.php');
    }


    public function getRepo($repo_name)
    {
        include('model/' . $repo_name . 'Model.php');
        $repo_name .= 'Model';
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

    public function generate_token($id,$typeAccount,$role)
    {
        $header = json_encode([
            'typ' => 'JWT',
            'alg' => 'HS256'
        ]);
        $payload = json_encode([
            'typeAccount' => $typeAccount,
            'id' => $id,
            'role' => $role
        ]);
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', '|'], base64_encode($header));
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', '|'], base64_encode($payload));
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, "key", true);
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', '|'], base64_encode($signature));
        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
        return $jwt;
    }

    public function verify_and_decode_token($jwt)
    {
        $endOfHeader = stripos($jwt,".");
        $header1 = substr($jwt,0,$endOfHeader);
        $jwt = substr($jwt,$endOfHeader+1);
        $endOfPayload = stripos($jwt,".");
        $payload1 = substr($jwt,0,$endOfPayload);
        $signature1 = substr($jwt,$endOfPayload+1);
        $signature1 = str_replace(['-', '_', '|'], ['+', '/', '='], $signature1);
        $signature1 = base64_decode($signature1);
        if (hash_hmac('sha256', $header1 . "." . $payload1, "key", true) == $signature1) {
            $payload1 = str_replace(['-', '_', '|'], ['+', '/', '='], $payload1);
            $payload1 = base64_decode($payload1);
            return $payload1;
        }  
        return false;
    }

}
