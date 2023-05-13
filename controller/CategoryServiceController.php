<?php
class CategoryServiceController extends BaseController
{

    public function category_service_page()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {            
            $this->renderView(
                ''
            );
        }
    }

    public function data_category_service()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $categoryServiceRepo = $this->getRepo('categoryService');
            $categoryService = $categoryServiceRepo->getData("");              
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
