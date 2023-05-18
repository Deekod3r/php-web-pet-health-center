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

    public function data_news()
    {
        $responseCode = ResponseCode::FAIL;
        $message = sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $key = "";
            $newsModel = $this->get_model('news');
            $limit = 0;
            $offset = 0;
            if (isset($_GET['newsKey']) and $_GET['newsKey'] != '') {
                $key .= "and concat(news_title, news_content, news_description) like '%" . $_GET['newsKey'] . "%'";
            }
            if (isset($_GET['categoryNews']) and $_GET['categoryNews'] != '') {
                $key .= "and cn_id = " . $_GET['categoryNews'];
            }
            if (isset($_GET['idNews']) and $_GET['idNews'] != '') {
                $key .= "and news_id = " . $_GET['idNews'];
            }
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
                $responseCode = "01";
                $message = sprintf(ResponseMessage::SELECT_MESSAGE,"tin tức","thành công.");
                $data = [
                    'news' => $news,
                    'count' => $count
                ];
            } else {
                $responseCode = "04";
                $message = sprintf(ResponseMessage::DATA_EMPTY_MESSAGE,"tin tức");
            }
        } else {
            $responseCode = "98";
            $message = sprintf(ResponseMessage::REQUEST_INVALID);
        }
        $this->response($responseCode, $message, $data);
    }


    public function detail_news()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->render_view(
                'single'
            );
        } else  $this->redirect('home', 'index');
    }
}
