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

    public function login_page()
    {
        if (isset($_SESSION['login']) && $_SESSION['login']) {
           $this->redirect('home', 'index');
        } else  {
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
        //var_dump($data);
        $adminRepo = $this->get_model('admin');
        $customerRepo = $this->get_model('customer');
        $admin = $adminRepo->get_by_username(htmlspecialchars($request_login['lg-username']));
        // , htmlspecialchars($request_login['lg-password'])
        // var_dump($admin);
        if ($admin == null) {
            $customer = $customerRepo->get_by_phone(htmlspecialchars($request_login['lg-username']));
            // , htmlspecialchars($request_login['lg-password'])
            // var_dump($customer);
            if ($customer == null) {
                // $_SESSION['check_login'] = false;
                // $_SESSION['msg_login'] = "Thông tin không hợp lệ.";
                //$this->redirect('home', 'login_page');
                //return false;
                $result = [
                    "statusCode" => "0",
                    "message" => "Tài khoản không tồn tại.",
                    "data" => []
                ];
                echo json_encode($result);
            } else {
                if ($customer['ctm_password'] == $request_login['lg-password']) {
                    $_SESSION['login'] = true;
                    // $_SESSION['admin'] = false;
                    // $_SESSION['can_feedback'] = $customer['ctm_can_feedback'];
                    // $_SESSION['id'] = $customer['ctm_id'];
                    //$this->redirect('home', 'index');
                    //return true;
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
                    // $_SESSION['admin'] = false;
                    // $_SESSION['can_feedback'] = $customer['ctm_can_feedback'];
                    // $_SESSION['id'] = $customer['ctm_id'];
                    //$this->redirect('home', 'index');
                    //return true;
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
                // $_SESSION['admin'] = true;
                // $_SESSION['role'] = $admin['ad_role'];
                // $_SESSION['id'] = $admin['ad_id'];
                //$this->redirect('home', 'index');
                //return true;
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
                // $_SESSION['admin'] = true;
                // $_SESSION['role'] = $admin['ad_role'];
                // $_SESSION['id'] = $admin['ad_id'];
                //$this->redirect('home', 'index');
                //return true;
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
