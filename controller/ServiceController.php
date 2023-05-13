<?php
class ServiceController extends BaseController
{

    public function service_page()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {            
            $this->renderView(
                'service'
            );
        }
    }

    public function data_service()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $key = "";
            if (isset($_GET['sv_name']) and $_GET['sv_name'] != '') {
                $key .= "and concat(sv_name,sv_description) like '%" . $_GET['sv_name'] . "%'";
            }
            if (isset($_GET['category_service']) and $_GET['category_service'] != '') {
                $key .= " and cs_id = " . $_GET['category_service'];
            }
            if (isset($_GET['type_pet']) and $_GET['type_pet'] != '') {
                $key .= " and sv_pet in (" . $_GET['type_pet'] . "," . Enum::TYPE_BOTH . ")";
            }
            $serviceRepo = $this->getRepo('service');
            $service = $serviceRepo->getData($key);         
            $result = [
                "statusCode" => "1",
                "message" => "OK",
                "data" => [
                    'service' => $service
                ]
            ];
            echo json_encode($result);
        }
    }

}
