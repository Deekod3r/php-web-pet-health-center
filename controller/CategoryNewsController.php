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
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $categoryNewsModel = $this->get_model('categoryNews');
            $categoryNews = $categoryNewsModel->get_data("");              
            if ($categoryNews != null) {
                $responseCode = ResponseCode::SUCCESS;
                $message = "SERV: " . sprintf(ResponseMessage::SELECT_MESSAGE,"danh mục tin tức","thành công.");
                $data = [
                    'categoryNews' => $categoryNews                
                ];
            } else {
                $responseCode = ResponseCode::DATA_EMPTY;
                $message = "SERV: " . sprintf(ResponseMessage::DATA_EMPTY_MESSAGE,"danh mục tin tức");
            }
        } else {
            $responseCode = ResponseCode::REQUEST_INVALID;
            $message = "SERV: " . sprintf(ResponseMessage::REQUEST_INVALID_MESSAGE);
        }
        $this->response($responseCode,$message,$data);
    }

}
