<?php
class ServiceController extends BaseController
{

    public function service_page()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->render_view(
                'service'
            );
        }
    }

    public function data_service()
    {
        $responseCode = ResponseCode::FAIL;
        $message = sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE,"");
        $data[] = null;
        try {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $key = "";
                $limit = 0;
                $offset = 0;
                $serviceModel = $this->get_model('service');
                if (isset($_GET['svName']) and $_GET['svName'] != '') {
                    $key .= "concat(sv_name,sv_description) like '%" . $_GET['svName'] . "%'";
                }
                if (isset($_GET['categoryService']) and $_GET['categoryService'] != '') {
                    if ($key != '') $key = " and " . $key;
                    $key .= " cs_id = " . $_GET['categoryService'];
                }
                if (isset($_GET['typePet']) and $_GET['typePet'] != '') {
                    if ($key != '') $key = " and " . $key;
                    $key .= " sv_pet in (" . $_GET['typePet'] . "," . Enum::TYPE_BOTH . ")";
                }
                if ($key != '') $key = "where " . $key;
                //$message = $key;
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
                    $responseCode = ResponseCode::SUCCESS;
                    $message = sprintf(ResponseMessage::SELECT_MESSAGE,"dịch vụ","thành công.");
                    $data = [
                        'service' => $service,
                        'count' => $count
                    ];
                } else {
                    $responseCode = ResponseCode::DATA_EMPTY;
                    $message = sprintf(ResponseMessage::DATA_EMPTY_MESSAGE,"dịch vụ");
                }
            } else {
                $responseCode = ResponseCode::REQUEST_INVALID;
                $message = sprintf(ResponseMessage::REQUEST_INVALID_MESSAGE);
            }
        } catch (Exception $e) {
            $responseCode = ResponseCode::UNKNOWN_ERROR;
            $message = $e->getMessage();
        }
        $this->response($responseCode,$message,$data);
    }
}
