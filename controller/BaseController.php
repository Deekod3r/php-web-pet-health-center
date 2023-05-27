<?php
class BaseController
{

    private $secureKey = "nhom2@65pm2!@#$";

    public function get_secure_key()
    {
        return $this->secureKey;
    }
    public function __construct()
    {
        session_start();
    }

    public function render_view($viewName)
    {
        if (isset($_SESSION['login']) && $_SESSION['login'] == Enum::ADMIN) $view = "admin";
        else $view = "site";
        $path = "view/$view/";
        include($path . $viewName . '.php');
    }

    public function render_error($errorCode)
    {
        $path = 'view/error/error-';
        include($path . $errorCode . '.php');
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
        if (isset($_SESSION['login']) && $_SESSION['login'] == Enum::ROLE_CUSTOMER) {
            return true;
        } else return false;
    }

    public function check_admin()
    {
        if (isset($_SESSION['login']) && ($_SESSION['login'] == Enum::ADMIN)) {
            return true;
        } else return false;
    }

    public function check_admin_role($role)
    {
        if (isset($_SESSION["ad" . $role]) && $_SESSION["ad" . $role]) {
            return true;
        } else return false;
    }

    public function generate_token($id, $typeAccount, $role)
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
        $endOfHeader = stripos($jwt, ".");
        $headerSub = substr($jwt, 0, $endOfHeader);
        $jwt = substr($jwt, $endOfHeader + 1);
        $endOfPayload = stripos($jwt, ".");
        $payloadSub = substr($jwt, 0, $endOfPayload);
        $signatureSub = substr($jwt, $endOfPayload + 1);
        $signatureSub = str_replace(['-', '_', '|'], ['+', '/', '='], $signatureSub);
        $signatureSub = base64_decode($signatureSub);
        if (hash_hmac('sha256', $headerSub . "." . $payloadSub, $this->get_secure_key(), true) == $signatureSub) {
            $payloadSub = str_replace(['-', '_', '|'], ['+', '/', '='], $payloadSub);
            $payloadSub = base64_decode($payloadSub);
            return $payloadSub;
        }
        return false;
    }

    public function response($responseCode, $message, $data)
    {
        $result = [
            'responseCode' => $responseCode,
            'message' => $message,
            'data' => $data
        ];
        echo json_encode($result);
    }

    public $number = '/[0-9]/';
    public $lowerChars = '/[a-z]/';
    public $upperChars = '/[A-Z]/';
    public $specialChars = '/[\.!\'^£$%&*()}{@#~?><,|=_+¬-]/';
    //preg_match($number, $input);

    public function save_img($path, $file)
    {
        $target_dir = $path;
        $target_file = $target_dir . basename($file["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($file["tmp_name"]);
            if ($check == false) {
                return false;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            return false;
        }
        // Check file size
        if ($file["size"] > 500000) {
            echo "Sorry, your file is too large.";
            return false;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            return false;
        }

        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return true;
        } else {
            return false;
        }
    }
}
