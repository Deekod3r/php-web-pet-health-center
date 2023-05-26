<?php
class CategoryServiceController extends BaseController
{

    public function category_service_page()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->render_view(
                ''
            );
        } else $this->render_error('400');
    }

    public function data_category_service()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        try {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $categoryServiceModel = $this->get_model('categoryService');
                $categoryServices = $categoryServiceModel->get_data("");
                if ($categoryServices != null) {
                    $responseCode = "01";
                    $message = "SERV: " . sprintf(ResponseMessage::SELECT_MESSAGE,"danh mục dịch vụ","thành công.");
                    $data = [
                        'categoryServices' => $categoryServices                
                    ];
                } else {
                    $responseCode = "04";
                    $message = "SERV: " . sprintf(ResponseMessage::DATA_EMPTY_MESSAGE,"danh mục dịch vụ");
                }
            } else {
                $responseCode = "98";
                $message = "SERV: " . sprintf(ResponseMessage::REQUEST_INVALID_MESSAGE);
            }
        } catch (Exception $e) {
            $responseCode = ResponseCode::UNKNOWN_ERROR;
            $message = "SERV: " . $e->getMessage();
        }
        $this->response($responseCode, $message, $data);
    }

    public function add_category_service()
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
                        if (isset($_POST['csName']) && $_POST['csName'] != '' ) {
                            //&& isset($_FILES["svImg"]) && !$_FILES["svImg"]["name"] != ''
                            $id = json_decode($dataToken)->{'id'};
                            $admin = $this->get_model('admin')->get_by_id($id);
                            if ($admin != null) {
                                if ($admin['ad_role'] == Enum::ROLE_MANAGER) {
                                    //$img = $_FILES["svImg"];
                                    //if ($this->save_img(ServiceController::PATH_IMG_SERVICE,$img)) {
                                    $dataCategoryService = [
                                        'csName' => $_POST['csName']
                                    ];
                                    $categoryServiceModel = $this->get_model('categoryservice');
                                    if ($categoryServiceModel->save_data($dataCategoryService)) {
                                        $responseCode = ResponseCode::SUCCESS;
                                        $message = "SERV: " . sprintf(ResponseMessage::INSERT_MESSAGE, "nhóm dịch vụ", "thành công");
                                    } else {
                                        $message = "SERV: " . sprintf(ResponseMessage::INSERT_MESSAGE, "nhóm dịch vụ", "thất bại");
                                    }
                                    //} else {
                                    //    $message = "SERV: " . sprintf(ResponseMessage::INSERT_MESSAGE,"ảnh dịch vụ","thất bại");
                                    //}
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
                            $message = "SERV: " . sprintf(ResponseMessage::INPUT_EMPTY_MESSAGE, "nhóm dịch vụ");
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
    
    public function edit_category_service()
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
                        if (isset($_POST['csName']) && $_POST['csName'] != '' && isset($_POST['csId']) && $_POST['csId'] != '' ) {
                            //&& isset($_FILES["svImg"]) && !$_FILES["svImg"]["name"] != ''
                            $id = json_decode($dataToken)->{'id'};
                            $admin = $this->get_model('admin')->get_by_id($id);
                            if ($admin != null) {
                                if ($admin['ad_role'] == Enum::ROLE_MANAGER) {
                                    //$img = $_FILES["svImg"];
                                    //if ($this->save_img(ServiceController::PATH_IMG_SERVICE,$img)) {
                                    $dataCategoryService = [
                                        'cs_name' => $_POST['csName'],
                                    ];
                                    $categoryServiceModel = $this->get_model('categoryservice');
                                    if ($categoryServiceModel->update_data($dataCategoryService,$_POST['csId'])) {
                                        $responseCode = ResponseCode::SUCCESS;
                                        $message = "SERV: " . sprintf(ResponseMessage::UPDATE_MESSAGE, "nhóm dịch vụ", "thành công");
                                    } else {
                                        $message = "SERV: " . sprintf(ResponseMessage::UPDATE_MESSAGE, "nhóm dịch vụ", "thất bại");
                                    }
                                    //} else {
                                    //    $message = "SERV: " . sprintf(ResponseMessage::INSERT_MESSAGE,"ảnh dịch vụ","thất bại");
                                    //}
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
                            $message = "SERV: " . sprintf(ResponseMessage::INPUT_EMPTY_MESSAGE, "nhóm dịch vụ");
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
