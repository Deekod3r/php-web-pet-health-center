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
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $key = "";
            $newsRepo = $this->get_model('news');
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
            $count = $newsRepo->count_data($key);
            $key .= " order by news_date_release DESC ";
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
            }
            //echo $key . " order by news_date_release DESC";
            $news = $newsRepo->get_data($key);
            $result = [
                "statusCode" => "1",
                "message" => "OK",
                "data" => [
                    'news' => $news,
                    'count' => $count
                ]
            ];
            echo json_encode($result);
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

}
