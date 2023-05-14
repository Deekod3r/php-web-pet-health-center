<?php
class CategoryNewsController extends BaseController
{

    public function category_news_page()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {            
            $this->render_view(
                ''
            );
        }
    }

    public function data_category_news()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $categoryNewsRepo = $this->get_model('categoryNews');
            $categoryNews = $categoryNewsRepo->get_data("");              
            $result = [
                "statusCode" => "1",
                "message" => "OK",
                "data" => [
                    'categoryNews' => $categoryNews
                ]
            ];
            echo json_encode($result);
        }
    }

}
