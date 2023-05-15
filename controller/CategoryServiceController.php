<?php
class CategoryServiceController extends BaseController
{

    public function category_service_page()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {            
            $this->render_view(
                ''
            );
        }
    }

    public function data_category_service()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $categoryServiceModel = $this->get_model('categoryService');
            $categoryService = $categoryServiceModel->get_data("");              
            $result = [
                "statusCode" => "1",
                "message" => "OK",
                "data" => [
                    'categoryService' => $categoryService
                ]
            ];
            echo json_encode($result);
        }
    }

}
