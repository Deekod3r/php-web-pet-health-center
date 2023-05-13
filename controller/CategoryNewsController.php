<?php
class CategoryNewsController extends BaseController
{

    public function category_news_page()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {            
            $this->renderView(
                ''
            );
        }
    }

    public function data_category_news()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $categoryNewsRepo = $this->getRepo('categoryNews');
            $categoryNews = $categoryNewsRepo->getData("");              
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
