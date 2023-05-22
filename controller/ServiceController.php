<?php
class ServiceController extends BaseController
{

    public function service_page_ad()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->check_admin() && ($this->check_admin_role(Enum::ROLE_MANAGER) || $this->check_admin_role(Enum::ROLE_SALE))) {
                $this->render_view(
                    'service'
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
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE,"");
        $data[] = null;
        try {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $key = '';
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
                if ($key != '') $key = "where " . $key;
                // $message = "SERV: " . $key;
                // $data = $_GET;
                $count = $serviceModel->count_data($key);
                if ($count > 0) {
                    if (isset($_GET['limit']) and $_GET['limit'] != '') {
                        $limit = $_GET['limit'];
                        if ($limit > 0) {
                            $key .= " limit " . $limit;
                            if (isset($_GET['index']) and $_GET['index'] != '') {
                                $index = $_GET['index'];
                                if ($index > 1) {
                                    $offset = ($index-1) * $limit; 
                                }
                                if ($offset > 0) {
                                    $key .= " offset " . $offset;
                                }
                            }
                        }
                    }
                    $service = $serviceModel->get_data($key);
                    if ($service != null) {
                        $responseCode = ResponseCode::SUCCESS;
                        $message = "SERV: " . sprintf(ResponseMessage::SELECT_MESSAGE,"dịch vụ","thành công.");
                        $data = [
                            'service' => $service,
                            'count' => $count
                        ];
                    } else {
                        $responseCode = ResponseCode::DATA_EMPTY;
                        $message = "SERV: " . sprintf(ResponseMessage::DATA_EMPTY_MESSAGE,"dịch vụ");
                    }
                } else {
                    $responseCode = ResponseCode::DATA_EMPTY;
                    $message = "SERV: " . sprintf(ResponseMessage::DATA_EMPTY_MESSAGE,"dịch vụ");
                }
            } else {
                $responseCode = ResponseCode::REQUEST_INVALID;
                $message = "SERV: " . sprintf(ResponseMessage::REQUEST_INVALID_MESSAGE);
            }
        } catch (Exception $e) {
            $responseCode = ResponseCode::UNKNOWN_ERROR;
            $message = "SERV: " . $e->getMessage();
        }
        $this->response($responseCode,$message,$data);
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
                    $message = "SERV: " . sprintf(ResponseMessage::SELECT_MESSAGE,"dịch vụ","thành công.");
                    $data = [
                        'service' => $service                    
                    ];
                } else {
                    $responseCode = ResponseCode::DATA_EMPTY;
                    $message = "SERV: " . sprintf(ResponseMessage::DATA_EMPTY_MESSAGE,"dịch vụ");
                }
            } else {
                $responseCode = ResponseCode::REQUEST_INVALID;
                $message = "SERV: " . sprintf(ResponseMessage::REQUEST_INVALID_MESSAGE);
            } 
        }  catch (Exception $e) {
            $responseCode = ResponseCode::UNKNOWN_ERROR;
            $message = "SERV: " . $e->getMessage();
        }
        $this->response($responseCode, $message, $data);
    }
}
