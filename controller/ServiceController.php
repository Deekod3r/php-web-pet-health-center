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
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $key = "";
            $limit = 0;
            $offset = 0;
            $serviceModel = $this->get_model('service');
            if (isset($_GET['svName']) and $_GET['svName'] != '') {
                $key .= "and concat(sv_name,sv_description) like '%" . $_GET['svName'] . "%'";
            }
            if (isset($_GET['categoryService']) and $_GET['categoryService'] != '') {
                $key .= " and cs_id = " . $_GET['categoryService'];
            }
            if (isset($_GET['typePet']) and $_GET['typePet'] != '') {
                $key .= " and sv_pet in (" . $_GET['typePet'] . "," . Enum::TYPE_BOTH . ")";
            }
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
                $responseCode = "01";
                $message = sprintf(ResponseMessage::SELECT_MESSAGE,"dịch vụ","thành công.");
                $data = [
                    'service' => $service,
                    'count' => $count
                ];
            } else {
                $responseCode = "04";
                $message = sprintf(ResponseMessage::DATA_EMPTY_MESSAGE,"dịch vụ");
            }
        } else {
            $responseCode = "98";
            $message = sprintf(ResponseMessage::REQUEST_INVALID);
        }
        $this->response($responseCode,$message,$data);
    }
}
