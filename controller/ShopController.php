<?php
class ShopController extends BaseController
{

    public function about_page()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->render_view(
                'about'
            );
        } else $this->render_error('400');
    }

    public function contact_page()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->render_view(
            'contact'
            );
        } else $this->render_error('400');
    }

    public function shop_page_ad()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->check_admin() && $this->check_admin_role(Enum::ROLE_MANAGER)) {
                $this->render_view(
                    'shop'
                );
            } else $this->render_error('403');
        } else $this->render_error('400');
    }

    public function data_shop()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $shopModel = $this->get_model('shop');
                $shop = $shopModel->get_data("");
                if ($shop != null) {
                    $responseCode = ResponseCode::SUCCESS;
                    $message = "SERV: " . sprintf(ResponseMessage::SELECT_MESSAGE, "cửa hàng", "thành công.");
                    $data = [
                        'shop' => $shop
                    ];
                } else {
                    $responseCode = ResponseCode::DATA_EMPTY;
                    $message = "SERV: " . sprintf(ResponseMessage::DATA_EMPTY_MESSAGE, "cửa hàng");
                }
            } else {
                $responseCode = ResponseCode::REQUEST_INVALID;
                $message = "SERV: " . sprintf(ResponseMessage::REQUEST_INVALID_MESSAGE);
            }
        } catch (Exception $e) {
            $responseCode = ResponseCode::UNKNOWN_ERROR;
            $message = "SERV: " . $e->getMessage();
        }
        $this->response($responseCode, $message, $data);
    }

    public function edit_shop()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = $_POST;
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($this->check_admin() && $this->check_admin_role(Enum::ROLE_MANAGER)) {
                    $token = isset($_POST['token']) && $_POST['token'] != null ? $_POST['token'] : '';
                    $dataToken = $this->verify_and_decode_token($token);
                    if (!$dataToken) {
                        $responseCode = ResponseCode::TOKEN_INVALID;
                        $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE . " token:" . $token;
                    } else {
                        if (isset($_POST['shopName']) && $_POST['shopName'] != '' && isset($_POST['shopAddress']) && $_POST['shopAddress'] != '' && isset($_POST['shopMail']) && $_POST['shopMail'] != '' && isset($_POST['shopPhone']) && $_POST['shopPhone'] != '' && isset($_POST['shopFacebook']) && $_POST['shopFacebook'] != '' && isset($_POST['shopDesc']) && $_POST['shopDesc'] != '' ) {
                            $id = json_decode($dataToken)->{'id'};
                            $admin = $this->get_model('admin')->get_by_id($id);
                            if ($admin != null) {
                                if ($admin['ad_role'] == Enum::ROLE_MANAGER) {
                                    $shopModel = $this->get_model('shop');
                                    $dataShop = [
                                        'shop_name' => $_POST['shopName'],
                                        'shop_address' => $_POST['shopAddress'],
                                        'shop_description' => $_POST['shopDesc'],
                                        'shop_phone' => $_POST['shopPhone'],
                                        'shop_mail' => $_POST['shopMail'],
                                        'shop_facebook' => $_POST['shopFacebook']
                                    ];
                                    if ($shopModel->update_data($dataShop,1)) {
                                        $responseCode = ResponseCode::SUCCESS;
                                        $message = "SERV: " . sprintf(ResponseMessage::UPDATE_MESSAGE, "shop", "thành công");
                                    } else {
                                        $message = "SERV: " . sprintf(ResponseMessage::UPDATE_MESSAGE, "shop", "thất bại");
                                    }
                                } else {
                                    $responseCode = ResponseCode::ACCESS_DENIED;
                                    $message = "SERV1: " . ResponseMessage::ACCESS_DENIED_MESSAGE;
                                }
                            } else {
                                $responseCode = ResponseCode::OBJECT_DOES_NOT_EXIST;
                                $message = "SERV: " . sprintf(ResponseMessage::OBJECT_DOES_NOT_EXIST_MESSAGE, 'admin');
                            }
                        } else {
                            $responseCode = ResponseCode::INPUT_EMPTY;
                            $message = "SERV: " . sprintf(ResponseMessage::INPUT_EMPTY_MESSAGE, "shop");
                        }
                    }
                } else {
                    $responseCode = ResponseCode::ACCESS_DENIED;
                    $message = "SERV2: " . ResponseMessage::ACCESS_DENIED_MESSAGE ;
                }
            } else {
                $responseCode = ResponseCode::REQUEST_INVALID;
                $message = "SERV: " . sprintf(ResponseMessage::REQUEST_INVALID_MESSAGE);
            }
        } catch (Exception $e) {
            $responseCode = ResponseCode::UNKNOWN_ERROR;
            $message = "SERV: " . $e->getMessage();
        }
        $this->response($responseCode, $message, $data);
    }
}
