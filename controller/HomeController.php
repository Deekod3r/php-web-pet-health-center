<?php
class HomeController extends BaseController
{

    public function index()
    {
        $this->render_view(
            'index'
        );
    }

    public function index_admin()
    {
        $this->render_view_role(
            'index',
            'admin'
        );
    }

    public function error_page()
    {
        if (isset($_GET['error']) && $_GET['error'] != null && $_GET['error'] != '') {
            $this->render_error($_GET['error']);
        } else $this->render_error('404');
    }

    public function login_page()
    {
        if (isset($_SESSION['login']) && $_SESSION['login']) {
            $this->redirect('home', 'index');
        } else {
            $this->render_view('login');
        }
    }
    public function logout()
    {
        $_SESSION['login'] = null;
        //echo "haha";
        $result = [
            "statusCode" => "1",
            "message" => "OK",
            "data" => []
        ];
        echo json_encode($result);
    }

    public function login_action()
    {
        $request_login = $_POST;
        //var_dump($request_login);
        $adminModel = $this->get_model('admin');
        $customerModel = $this->get_model('customer');
        $admin = $adminModel->get_by_username(htmlspecialchars($request_login['lg-username']));
        // , htmlspecialchars($request_login['lg-password'])
        if ($admin == null) {
            $customer = $customerModel->get_by_phone(htmlspecialchars($request_login['lg-username']));
            // , htmlspecialchars($request_login['lg-password'])
            if ($customer == null) {
                $result = [
                    "statusCode" => "0",
                    "message" => "Tài khoản không tồn tại.",
                    "data" => []
                ];
                echo json_encode($result);
            } else {
                if ($customer['ctm_password'] == $request_login['lg-password']) {
                    $_SESSION['login'] = true;
                    $token = $this->generate_token($customer['ctm_id'], 'customer', -1);
                    $result = [
                        "statusCode" => "1",
                        "message" => "Đăng nhập thành công.",
                        "data" => [
                            "token" => $token,
                            "typeAccount" => "customer",
                        ]
                    ];
                    echo json_encode($result);
                } else {
                    $result = [
                        "statusCode" => "0",
                        "message" => "Sai mật khẩu.",
                        "data" => [
                            "token" => "",
                            "typeAccount" => "customer",
                        ]
                    ];
                    echo json_encode($result);
                }
            }
        } else {
            if ($request_login['lg-password'] == $admin['ad_password']) {
                $_SESSION['login'] = true;
                $token = $this->generate_token($admin['ad_id'], 'admin', $admin['ad_role']);
                $result = [
                    "statusCode" => "1",
                    "message" => "Đăng nhập thành công.",
                    "data" => [
                        "token" => $token,
                        "typeAccount" => "admin",
                    ]
                ];
                echo json_encode($result);
            } else {
                $result = [
                    "statusCode" => "0",
                    "message" => "Sai mật khẩu.",
                    "data" => [
                        "token" => "",
                        "typeAccount" => "admin",
                    ]
                ];
                echo json_encode($result);
            }
        }
    }
}
