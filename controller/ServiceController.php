<?php
class ServiceController extends BaseController
{

    const PATH_IMG_SERVICE = 'view/upload/admin/service/';
    public function service_page_ad()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->check_admin() && ($this->check_admin_role(Enum::ROLE_MANAGER) || $this->check_admin_role(Enum::ROLE_SALE))) {
                $this->render_view(
                    'service/service'
                );
            } else $this->render_error('403');
        } else $this->render_error('400');
    }


    public function service_add_page()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if ($this->check_admin() && ($this->check_admin_role(Enum::ROLE_MANAGER) || $this->check_admin_role(Enum::ROLE_SALE))) {
                $this->render_view(
                    'service/service-add'
                );
            } else $this->render_error('403');
        } else $this->render_error('400');
    }
    public function service_edit_page()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if ($this->check_admin() && ($this->check_admin_role(Enum::ROLE_MANAGER) || $this->check_admin_role(Enum::ROLE_SALE))) {
                $this->render_view(
                    'service/service-edit'
                );
            } else $this->render_error('403');
        } else $this->render_error('400');
    }
    public function service_page()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->render_view(
                'service'
            );
        } else $this->render_error('400');
    }



    public function data_service()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        try {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $key = '';
                $endPrice = 0;
                $startPrice = 0;
                $limit = 0;
                $offset = 0;
                $serviceModel = $this->get_model('service');
                if (isset($_GET['svName']) and $_GET['svName'] != '') {
                    $key .= "concat(sv_name,sv_description) like '%" . $_GET['svName'] . "%'";
                }
                if (isset($_GET['typePet']) and $_GET['typePet'] != '') {
                    if ($key != '') {
                        $key .= ' and ';
                    }
                    $key .= " sv_pet in (" . $_GET['typePet'] . "," . Enum::TYPE_BOTH . ")";
                }
                if (isset($_GET['categoryService']) and $_GET['categoryService'] != '') {
                    if ($key != '') {
                        $key .= ' and ';
                    }
                    $key .= " cs_id = " . $_GET['categoryService'];
                }
                if (isset($_GET['endPrice'])) {
                    if ($_GET['endPrice'] > 0) {
                        $endPrice = $_GET['endPrice'];
                    }
                }
                if (isset($_GET['startPrice'])) {
                    if ($_GET['startPrice'] > 0) {
                        $startPrice = $_GET['startPrice'];
                    }
                }
                if ($endPrice >= $startPrice && $endPrice > 0) {
                    if ($key != '') {
                        $key .= ' and ';
                    }
                    $key .= " sv_price between " . $_GET['startPrice'] . " and " . $_GET['endPrice'];
                } else {
                    if ($key != '') {
                        $key .= ' and ';
                    }
                    $key .= " sv_price >= " . $_GET['startPrice'];
                }
                if (isset($_GET['statusSV']) and $_GET['statusSV'] != '') {
                    if ($key != '') {
                        $key .= ' and ';
                    }
                    $key .= " sv_status = " . $_GET['statusSV'];
                }
                if (!isset($_SESSION['login']) || (isset($_SESSION['login']) && $_SESSION['login'] != Enum::ADMIN)) {
                    if ($key != '') {
                        $key .= ' and ';
                    }
                    $key .= " sv_status = 1 ";
                }

                if ($key != '') $key = "where " . $key;
                // $message = "SERV: " . $key;
                // $data = $_GET;
                $count = $serviceModel->count_data($key);
                if ($count > 0) {
                    if (isset($_GET['limit']) and $_GET['limit'] != '') {
                        $key .= " order by sv_status DESC ";
                        $limit = $_GET['limit'];
                        if ($limit > 0) {
                            $key .= " limit " . $limit;
                            if (isset($_GET['index']) and $_GET['index'] != '') {
                                $index = $_GET['index'];
                                if ($index > 1) {
                                    $offset = ($index - 1) * $limit;
                                }
                                if ($offset > 0) {
                                    $key .= " offset " . $offset;
                                }
                            }
                        }
                    }
                    $services = $serviceModel->get_data($key);
                    if ($services != null) {
                        $responseCode = ResponseCode::SUCCESS;
                        $message = "SERV: " . sprintf(ResponseMessage::SELECT_MESSAGE, "dịch vụ", "thành công.");
                        $data = [
                            'services' => $services,
                            'count' => $count
                        ];
                    } else {
                        $responseCode = ResponseCode::DATA_EMPTY;
                        $message = "SERV: " . sprintf(ResponseMessage::DATA_EMPTY_MESSAGE, "dịch vụ");
                    }
                } else {
                    $responseCode = ResponseCode::DATA_EMPTY;
                    $message = "SERV: " . sprintf(ResponseMessage::DATA_EMPTY_MESSAGE, "dịch vụ");
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

    public function data_detail_service()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        try {
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['idService'])) {
                $serviceModel = $this->get_model('service');
                $service = $serviceModel->get_by_id($_GET['idService']);
                if ($service != null) {
                    $responseCode = ResponseCode::SUCCESS;
                    $message = "SERV: " . sprintf(ResponseMessage::SELECT_MESSAGE, "dịch vụ", "thành công.");
                    $data = [
                        'service' => $service
                    ];
                } else {
                    $responseCode = ResponseCode::DATA_EMPTY;
                    $message = "SERV: " . sprintf(ResponseMessage::DATA_EMPTY_MESSAGE, "dịch vụ");
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

    public function add_service()
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
                        if (isset($_POST['svName']) && $_POST['svName'] != '' && isset($_POST['svDescription']) && $_POST['svDescription'] != '' && isset($_POST['categoryService']) && $_POST['categoryService'] != '' && isset($_POST['typePet']) && $_POST['typePet'] != '' && isset($_POST['svPrice']) && $_POST['svPrice'] != '' && isset($_POST['svStatus']) && $_POST['svStatus'] != '') {
                            //&& isset($_FILES["svImg"]) && !$_FILES["svImg"]["name"] != ''
                            $id = json_decode($dataToken)->{'id'};
                            $admin = $this->get_model('admin')->get_by_id($id);
                            if ($admin != null) {
                                if ($admin['ad_role'] == Enum::ROLE_MANAGER) {
                                    //$img = $_FILES["svImg"];
                                    //if ($this->save_img(ServiceController::PATH_IMG_SERVICE,$img)) {
                                    $dataService = [
                                        'name' => $_POST['svName'],
                                        'price' => $_POST['svPrice'],
                                        'description' => $_POST['svDescription'],
                                        'pet' => $_POST['typePet'],
                                        //'img' => ServiceController::PATH_IMG_SERVICE . $img['name'],
                                        'cs' => $_POST['categoryService'],
                                        'status' => $_POST['svStatus']
                                    ];
                                    $serviceModel = $this->get_model('service');
                                    if ($serviceModel->save_data($dataService)) {
                                        $responseCode = ResponseCode::SUCCESS;
                                        $message = "SERV: " . sprintf(ResponseMessage::INSERT_MESSAGE, "dịch vụ", "thành công");
                                    } else {
                                        $message = "SERV: " . sprintf(ResponseMessage::INSERT_MESSAGE, "dịch vụ", "thất bại");
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
                            $message = "SERV: " . sprintf(ResponseMessage::INPUT_EMPTY_MESSAGE, "dịch vụ");
                        }
                    }
                } else {
                    $responseCode = ResponseCode::ACCESS_DENIED;
                    $message = "SERV2: " . ResponseMessage::ACCESS_DENIED_MESSAGE . " 1" . $this->check_admin_role(Enum::ROLE_MANAGER) . " 2" . $this->check_admin() . " 3" . $this->check_login();
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

    public function edit_service()
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
                        if (isset($_POST['svId']) && $_POST['svId'] != '' && isset($_POST['svName']) && $_POST['svName'] != '' && isset($_POST['svDescription']) && $_POST['svDescription'] != '' && isset($_POST['categoryService']) && $_POST['categoryService'] != '' && isset($_POST['typePet']) && $_POST['typePet'] != '' && isset($_POST['svPrice']) && $_POST['svPrice'] != '' && isset($_POST['svStatus']) && $_POST['svStatus'] != '') {
                            //&& isset($_FILES["svImg"]) && !$_FILES["svImg"]["name"] != ''
                            $id = json_decode($dataToken)->{'id'};
                            $admin = $this->get_model('admin')->get_by_id($id);
                            if ($admin != null) {
                                if ($admin['ad_role'] == Enum::ROLE_MANAGER) {
                                    //$img = $_FILES["svImg"];
                                    //if ($this->save_img(ServiceController::PATH_IMG_SERVICE,$img)) {
                                    $serviceModel = $this->get_model('service');
                                    $service = $serviceModel->get_by_id($_POST['svId']);
                                    if ($service != null) {
                                        $dataService = [
                                            'sv_name' => $_POST['svName'],
                                            'sv_price' => $_POST['svPrice'],
                                            'sv_description' => $_POST['svDescription'],
                                            'sv_pet' => $_POST['typePet'],
                                            //'img' => ServiceController::PATH_IMG_SERVICE . $img['name'],
                                            'cs_id' => $_POST['categoryService'],
                                            'sv_status' => $_POST['svStatus']
                                        ];
                                        if ($serviceModel->update_data($dataService,$_POST['svId'])) {
                                            $responseCode = ResponseCode::SUCCESS;
                                            $message = "SERV: " . sprintf(ResponseMessage::UPDATE_MESSAGE, "dịch vụ", "thành công");
                                        } else {
                                            $message = "SERV: " . sprintf(ResponseMessage::UPDATE_MESSAGE, "dịch vụ", "thất bại");
                                        }
                                    } else {
                                        $responseCode = ResponseCode::OBJECT_DOES_NOT_EXIST;
                                        $message = "SERV: " . sprintf(ResponseMessage::OBJECT_DOES_NOT_EXIST_MESSAGE,"Dịch vụ");
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
                            $message = "SERV: " . sprintf(ResponseMessage::INPUT_EMPTY_MESSAGE, "dịch vụ");
                        }
                    }
                } else {
                    $responseCode = ResponseCode::ACCESS_DENIED;
                    $message = "SERV2: " . ResponseMessage::ACCESS_DENIED_MESSAGE . " 1" . $this->check_admin_role(Enum::ROLE_MANAGER) . " 2" . $this->check_admin() . " 3" . $this->check_login();
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

    public function delete_service()
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
                        if (isset($_POST['idService']) && $_POST['idService'] != '') {
                            //&& isset($_FILES["svImg"]) && !$_FILES["svImg"]["name"] != ''
                            $id = json_decode($dataToken)->{'id'};
                            $admin = $this->get_model('admin')->get_by_id($id);
                            if ($admin != null) {
                                if ($admin['ad_role'] == Enum::ROLE_MANAGER) {
                                    //$img = $_FILES["svImg"];
                                    //if ($this->save_img(ServiceController::PATH_IMG_SERVICE,$img)) {
                                    $serviceModel = $this->get_model('service');
                                    $service = $serviceModel->get_by_id($_POST['idService']);
                                    if ($service != null) {
                                        if ($serviceModel->delete_data($_POST['idService'])) {
                                            $responseCode = ResponseCode::SUCCESS;
                                            $message = "SERV: " . sprintf(ResponseMessage::DELETE_MESSAGE, "dịch vụ", "thành công");
                                        } else {
                                            $message = "SERV: " . sprintf(ResponseMessage::DELETE_MESSAGE, "dịch vụ", "thất bại");
                                        }
                                    } else {
                                        $responseCode = ResponseCode::OBJECT_DOES_NOT_EXIST;
                                        $message = "SERV: " . sprintf(ResponseMessage::OBJECT_DOES_NOT_EXIST_MESSAGE,"Dịch vụ");
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
                            $message = "SERV: " . sprintf(ResponseMessage::INPUT_EMPTY_MESSAGE, "dịch vụ");
                        }
                    }
                } else {
                    $responseCode = ResponseCode::ACCESS_DENIED;
                    $message = "SERV2: " . ResponseMessage::ACCESS_DENIED_MESSAGE . " 1" . $this->check_admin_role(Enum::ROLE_MANAGER) . " 2" . $this->check_admin() . " 3" . $this->check_login();
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
