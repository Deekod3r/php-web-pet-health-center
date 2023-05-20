<?php
class NewsController extends BaseController
{

    public function news_page()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->render_view(
                'blog'
            );
        }
    }

    public function detail_news()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->render_view(
                'single'
            );
        } else  $this->redirect('home', 'index');
    }
    
    public function data_news()
    {
        $responseCode = ResponseCode::FAIL;
        $message = sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        try {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $key = "";
                $newsModel = $this->get_model('news');
                $limit = 0;
                $offset = 0;
                if (isset($_GET['newsKey']) and $_GET['newsKey'] != '') {
                    $key .= "concat(news_title, news_content, news_description) like '%" . $_GET['newsKey'] . "%'";
                }
                if (isset($_GET['categoryNews']) and $_GET['categoryNews'] != '') {
                    if ($key != '') $key = " and " . $key;
                    $key .= " cn_id = " . $_GET['categoryNews'];
                }
                if (isset($_GET['idNews']) and $_GET['idNews'] != '') {
                    if ($key != '') $key = " and " . $key;
                    $key .= " news_id = " . $_GET['idNews'];
                }
                if ($key != '') $key = "where " . $key;
                $count = $newsModel->count_data($key);
                if ($count > 0) {
                    $key .= " order by news_date_release DESC ";
                    if (isset($_GET['limit']) and $_GET['limit'] != '') {
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
                    $news = $newsModel->get_data($key);
                    $responseCode = ResponseCode::SUCCESS;
                    $message = sprintf(ResponseMessage::SELECT_MESSAGE,"tin tức","thành công.");
                    $data = [
                        'news' => $news,
                        'count' => $count
                    ];
                } else {
                    $responseCode = ResponseCode::DATA_EMPTY;
                    $message = sprintf(ResponseMessage::DATA_EMPTY_MESSAGE,"tin tức");
                }
            } else {
                $responseCode = ResponseCode::REQUEST_INVALID;
                $message = sprintf(ResponseMessage::REQUEST_INVALID_MESSAGE);
            } 
        }  catch (Exception $e) {
            $responseCode = ResponseCode::UNKNOWN_ERROR;
            $message = $e->getMessage();
        }
        $this->response($responseCode, $message, $data);
    }


}
