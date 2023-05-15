<?php
class BaseController
{

    private $secureKey = "nhom2@65pm2!@#$";

    public function get_secure_key(){
        return $this->secureKey;
    }
    public function __construct()
    {
        session_start();
    }

    public function render_view($viewName)
    {
        $path = 'view/';
        if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
            $path .= 'admin/';
        } else $path .= 'site/';
        include($path . $viewName . '.php');
    }

    public function render_error($errorCode)
    {
        $path = 'error/error-';
        include($path . $errorCode . '.php');
    }

    public function render_view_role($viewName, $role)
    {
        $path = 'view/';
        if ($role == 'admin') {
            $path .= 'admin/';
        } else $path .= 'site/';
        include($path . $viewName . '.php');
    }

    public function get_model($model)
    {
        include('model/' . $model . 'Model.php');
        $model .= 'Model';
        $modelObj = new $model();
        return $modelObj;
    }
    public function redirect($controller, $action)
    {
        header("Location: ?controller=" . $controller . "&action=" . $action);
    }

    public function check_login()
    {
        if (!isset($_SESSION['login']) || !$_SESSION['login']) {
            include('view/error/error-403.php');
            return false;
        } else return true;
    }

    public function check_admin()
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
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $this->get_secure_key(), true);
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', '|'], base64_encode($signature));
        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
        return $jwt;
    }

    public function verify_and_decode_token($jwt)
    {
        $endOfHeader = stripos($jwt,".");
        $headerSub = substr($jwt,0,$endOfHeader);
        $jwt = substr($jwt,$endOfHeader+1);
        $endOfPayload = stripos($jwt,".");
        $payloadSub = substr($jwt,0,$endOfPayload);
        $signatureSub = substr($jwt,$endOfPayload+1);
        $signatureSub = str_replace(['-', '_', '|'], ['+', '/', '='], $signatureSub);
        $signatureSub = base64_decode($signatureSub);
        if (hash_hmac('sha256', $headerSub . "." . $payloadSub, $this->get_secure_key(), true) == $signatureSub) {
            $payloadSub = str_replace(['-', '_', '|'], ['+', '/', '='], $payloadSub);
            $payloadSub = base64_decode($payloadSub);
            return $payloadSub;
        }  
        return false;
    }

    public function response($status, $message, $data) {
        $result = [
            'statusCode' => $status,
            'message' => $message,
            'data' => $data
        ];
        echo json_encode($result);
    }
}
