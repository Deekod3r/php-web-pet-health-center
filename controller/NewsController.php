<?php
class NewsController extends BaseController
{
    const PATH_IMG_NEWS = 'view/upload/admin/news/';

    public function news_page()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->render_view(
                'blog'
            );
        } else $this->render_error('400');
    }

    public function news_add_page()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->render_view(
                'news/news-add'
            );
        } else $this->render_error('400');
    }

    public function news_edit_page()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->render_view(
                'news/news-edit'
            );
        } else $this->render_error('400');
    }

    public function detail_news()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->render_view(
                'single'
            );
        } else $this->render_error('400');
    }
    
    public function news_page_ad()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->check_admin() && ($this->check_admin_role(Enum::ROLE_MANAGER) || $this->check_admin_role(Enum::ROLE_NEWS))) {
                $this->render_view(
                    'news/news'
                );
            } else $this->render_error('403');
        } else $this->render_error('400');
    }

    public function data_news()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        try {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $key = "";
                $limit = 0;
                $offset = 0;
                if (isset($_GET['newsKey']) and $_GET['newsKey'] != '') {
                    $key .= "news_title like '%" . htmlspecialchars($_GET['newsKey']) . "%'";
                }
                if (isset($_GET['categoryNews']) and $_GET['categoryNews'] != '') {
                    if ($key != '') $key = $key . " and ";
                    $key .= " cn_id = " . $_GET['categoryNews'];
                }
                if (isset($_GET['newsYear']) and $_GET['newsYear'] != '') {
                    if ($key != '') $key = $key . " and ";
                    $key .= " year(news_date_release) = " . $_GET['newsYear'];
                }
                if (isset($_GET['newsMonth']) and $_GET['newsMonth'] != '') {
                    if ($key != '') $key = $key . " and ";
                    $key .= " month(news_date_release) = " . $_GET['newsMonth'];
                }
                if (!isset($_SESSION['login']) || (isset($_SESSION['login']) && $_SESSION['login'] != Enum::ADMIN)) {
                    if ($key != '') {
                        $key .= ' and ';
                    }
                    $key .= " news_active = true ";
                } else if (isset($_GET['newsStatus']) and $_GET['newsStatus'] != '') {
                    if ($key != '') $key = $key . " and ";
                    $key .= " news_active = " . $_GET['newsStatus'];
                }
                if ($key != '') $key = "where " . $key;
                $newsModel = $this->get_model('news');
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
                    if ($news !== null) { 
                        $responseCode = ResponseCode::SUCCESS;
                        $message = "SERV: " . sprintf(ResponseMessage::SELECT_MESSAGE,"tin tức","thành công.");
                        $data = [
                            'news' => $news,
                            'count' => $count
                        ];
                    } else {
                        $responseCode = ResponseCode::DATA_EMPTY;
                        $message = "SERV: " . sprintf(ResponseMessage::DATA_EMPTY_MESSAGE,"tin tức");
                    }
                } else {
                    $responseCode = ResponseCode::DATA_EMPTY;
                    $message = "SERV: " . sprintf(ResponseMessage::DATA_EMPTY_MESSAGE,"tin tức");
                }
            } else {
                $responseCode = ResponseCode::REQUEST_INVALID;
                $message = "SERV: " . sprintf(ResponseMessage::REQUEST_INVALID_MESSAGE);
            } 
        }  catch (Exception $e) {
            $responseCode = ResponseCode::UNKNOWN_ERROR;
            $message = "SERV: " . $e->getMessage();
        }
        $this->response($responseCode, $message, $data);
    }

    public function data_detail_news()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        try {
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['idNews'])) {
                $newsModel = $this->get_model('news');
                $news = $newsModel->get_by_id($_GET['idNews']);
                if ($news != null) {
                    $responseCode = ResponseCode::SUCCESS;
                    $message = "SERV: " . sprintf(ResponseMessage::SELECT_MESSAGE,"tin tức","thành công.");
                    $data = [
                        'news' => $news                    
                    ];
                } else {
                    $responseCode = ResponseCode::DATA_EMPTY;
                    $message = "SERV: " . sprintf(ResponseMessage::DATA_EMPTY_MESSAGE,"tin tức");
                }
            } else {
                $responseCode = ResponseCode::REQUEST_INVALID;
                $message = "SERV: " . sprintf(ResponseMessage::REQUEST_INVALID_MESSAGE);
            } 
        }  catch (Exception $e) {
            $responseCode = ResponseCode::UNKNOWN_ERROR;
            $message = "SERV: " . $e->getMessage();
        }
        $this->response($responseCode, $message, $data);
    }

    public function delete_news()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = $_POST;
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($this->check_admin() && $this->check_admin_role(Enum::ROLE_MANAGER)) {
                    $token = isset($_POST['token']) && $_POST['token'] != null ? $_POST['token'] : '';
                    $dataToken = $this->verify_and_decode_token($token);
                    if (!$dataToken) {
                        $responseCode = ResponseCode::TOKEN_INVALID;
                        $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE . " token:" . $token;
                    } else {
                        if (isset($_POST['idNews']) && $_POST['idNews'] != '') {
                            $id = json_decode($dataToken)->{'id'};
                            $admin = $this->get_model('admin')->get_by_id($id);
                            if ($admin != null) {
                                if ($admin['ad_role'] == Enum::ROLE_MANAGER) {
                                    $newsModel = $this->get_model('news');
                                    $news = $newsModel->get_by_id($_POST['idNews']);
                                    if ($news != null) {
                                        if ($newsModel->delete_data($_POST['idNews'])) {
                                            $responseCode = ResponseCode::SUCCESS;
                                            $message = "SERV: " . sprintf(ResponseMessage::DELETE_MESSAGE, "tin tức", "thành công");
                                        } else {
                                            $message = "SERV: " . sprintf(ResponseMessage::DELETE_MESSAGE, "tin tức", "thất bại");
                                        }
                                    } else {
                                        $responseCode = ResponseCode::OBJECT_DOES_NOT_EXIST;
                                        $message = "SERV: " . sprintf(ResponseMessage::OBJECT_DOES_NOT_EXIST_MESSAGE,"Tin tức");
                                    }
                                } else {
                                    $responseCode = ResponseCode::ACCESS_DENIED;
                                    $message = "SERV1: " . ResponseMessage::ACCESS_DENIED_MESSAGE;
                                }
                            } else {
                                $responseCode = ResponseCode::OBJECT_DOES_NOT_EXIST;
                                $message = "SERV: " . sprintf(ResponseMessage::OBJECT_DOES_NOT_EXIST_MESSAGE, 'admin');
                            }
                        } else {
                            $responseCode = ResponseCode::INPUT_EMPTY;
                            $message = "SERV: " . sprintf(ResponseMessage::INPUT_EMPTY_MESSAGE, "tin tức");
                        }
                    }
                } else {
                    $responseCode = ResponseCode::ACCESS_DENIED;
                    $message = "SERV2: " . ResponseMessage::ACCESS_DENIED_MESSAGE . " 1" . $this->check_admin_role(Enum::ROLE_MANAGER) . " 2" . $this->check_admin() . " 3" . $this->check_login();
                }
            } else {
                $responseCode = ResponseCode::REQUEST_INVALID;
                $message = "SERV: " . sprintf(ResponseMessage::REQUEST_INVALID_MESSAGE);
            }
        } catch (Exception $e) {
            $responseCode = ResponseCode::UNKNOWN_ERROR;
            $message = "SERV: " . $e->getMessage();
        }
        $this->response($responseCode, $message, $data);
    }

    public function add_news()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($this->check_admin() && $this->check_admin_role(Enum::ROLE_MANAGER)) {
                    $token = isset($_POST['token']) && $_POST['token'] != null ? $_POST['token'] : '';
                    $dataToken = $this->verify_and_decode_token($token);
                    if (!$dataToken) {
                        $responseCode = ResponseCode::TOKEN_INVALID;
                        $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE . " token:" . $token;
                    } else {
                        if (isset($_POST['newsTitle']) && $_POST['newsTitle'] != '' && isset($_POST['newsDescription']) && $_POST['newsDescription'] != '' && isset($_POST['categoryNews']) && $_POST['categoryNews'] != '' && isset($_POST['newsContent']) && $_POST['newsContent'] != '' && isset($_POST['newsStatus']) && $_POST['newsStatus'] != '' && isset($_FILES["newsImg"]) && $_FILES["newsImg"]["name"] != '') {
                            //&& isset($_FILES["newsImg"]) && !$_FILES["newsImg"]["name"] != ''
                            $id = json_decode($dataToken)->{'id'};
                            $admin = $this->get_model('admin')->get_by_id($id);
                            if ($admin != null) {
                                if ($admin['ad_role'] == Enum::ROLE_MANAGER) {
                                    $img = $_FILES["newsImg"];
                                    if ($this->save_img(NewsController::PATH_IMG_NEWS,$img)) {
                                        $dataNews = [
                                            'title' => $_POST['newsTitle'],
                                            'content' => $_POST['newsContent'],
                                            'description' => $_POST['newsDescription'],
                                            'img' => newsController::PATH_IMG_NEWS . $img['name'],
                                            'cn' => $_POST['categoryNews'],
                                            'status' => $_POST['newsStatus'],
                                            'ad' => $id
                                        ];
                                        $newsModel = $this->get_model('news');
                                        // $data = $newsModel->save_data($dataNews);
                                        if ($newsModel->save_data($dataNews)) {
                                            $responseCode = ResponseCode::SUCCESS;
                                            $message = "SERV: " . sprintf(ResponseMessage::INSERT_MESSAGE, "tin tức", "thành công");
                                        } else {
                                            $message = "SERV: " . sprintf(ResponseMessage::INSERT_MESSAGE, "tin tức", "thất bại2");
                                        }
                                    } else {
                                        $data = $img['name'];
                                        $message = "SERV: " . sprintf(ResponseMessage::INSERT_MESSAGE,"tin tức","thất bại1");
                                    }
                                } else {
                                    $responseCode = ResponseCode::ACCESS_DENIED;
                                    $message = "SERV1: " . ResponseMessage::ACCESS_DENIED_MESSAGE;
                                }
                            } else {
                                $responseCode = ResponseCode::OBJECT_DOES_NOT_EXIST;
                                $message = "SERV: " . sprintf(ResponseMessage::OBJECT_DOES_NOT_EXIST_MESSAGE, 'admin');
                            }
                        } else {
                            $responseCode = ResponseCode::INPUT_EMPTY;
                            $message = "SERV: " . sprintf(ResponseMessage::INPUT_EMPTY_MESSAGE, "tin tức");
                        }
                    }
                } else {
                    $responseCode = ResponseCode::ACCESS_DENIED;
                    $message = "SERV2: " . ResponseMessage::ACCESS_DENIED_MESSAGE . " 1" . $this->check_admin_role(Enum::ROLE_MANAGER) . " 2" . $this->check_admin() . " 3" . $this->check_login();
                }
            } else {
                $responseCode = ResponseCode::REQUEST_INVALID;
                $message = "SERV: " . sprintf(ResponseMessage::REQUEST_INVALID_MESSAGE);
            }
        } catch (Exception $e) {
            $responseCode = ResponseCode::UNKNOWN_ERROR;
            $message = "SERV: " . $e->getMessage();
        }
        $this->response($responseCode, $message, $data);
    }

    public function edit_news()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($this->check_admin() && $this->check_admin_role(Enum::ROLE_MANAGER)) {
                    $token = isset($_POST['token']) && $_POST['token'] != null ? $_POST['token'] : '';
                    $dataToken = $this->verify_and_decode_token($token);
                    if (!$dataToken) {
                        $responseCode = ResponseCode::TOKEN_INVALID;
                        $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE . " token:" . $token;
                    } else {
                        if (isset($_POST['newsTitle']) && $_POST['newsTitle'] != '' && isset($_POST['newsDescription']) && $_POST['newsDescription'] != '' && isset($_POST['categoryNews']) && $_POST['categoryNews'] != '' && isset($_POST['newsContent']) && $_POST['newsContent'] != '' && isset($_POST['newsStatus']) && $_POST['newsStatus'] != '') {
                            $id = json_decode($dataToken)->{'id'};
                            $admin = $this->get_model('admin')->get_by_id($id);
                            if ($admin != null) {
                                if ($admin['ad_role'] == Enum::ROLE_MANAGER) {
                                    $newsModel = $this->get_model('news');
                                    if (isset($_FILES["newsImg"]) && $_FILES["newsImg"]["name"] != '') {
                                        $img = $_FILES["newsImg"];
                                        if ($this->save_img(NewsController::PATH_IMG_NEWS,$img)) {
                                            $dataNews = [
                                                'news_img' => newsController::PATH_IMG_NEWS . $img['name'],
                                                'news_title' => $_POST['newsTitle'],
                                                'news_content' => $_POST['newsContent'],
                                                'news_description' => $_POST['newsDescription'],
                                                'cn_id' => $_POST['categoryNews'],
                                                'news_active' => $_POST['newsStatus'],
                                                'ad_id' => $id
                                            ];
                                            if ($newsModel->update_data($dataNews,$_POST['newsId'])) {
                                                $responseCode = ResponseCode::SUCCESS;
                                                $message = "SERV: " . sprintf(ResponseMessage::UPDATE_MESSAGE, "tin tức", "thành công");
                                            } else {
                                                $message = "SERV: " . sprintf(ResponseMessage::UPDATE_MESSAGE, "tin tức", "thất bại");
                                            }
                                        } else {
                                            $data = $img['name'];
                                            $message = "SERV: " . sprintf(ResponseMessage::UPDATE_MESSAGE,"tin tức","thất bại");
                                        }
                                    } else {
                                        $dataNews = [
                                            'news_title' => $_POST['newsTitle'],
                                            'news_content' => $_POST['newsContent'],
                                            'news_description' => $_POST['newsDescription'],
                                            'cn_id' => $_POST['categoryNews'],
                                            'news_active' => $_POST['newsStatus'],
                                            'ad_id' => $id
                                        ];
                                        if ($newsModel->update_data($dataNews,$_POST['newsId'])) {
                                            $responseCode = ResponseCode::SUCCESS;
                                            $message = "SERV: " . sprintf(ResponseMessage::UPDATE_MESSAGE, "tin tức", "thành công");
                                        } else {
                                            $message = "SERV: " . sprintf(ResponseMessage::UPDATE_MESSAGE, "tin tức", "thất bại");
                                        }
                                    }  
                                } else {
                                    $responseCode = ResponseCode::ACCESS_DENIED;
                                    $message = "SERV1: " . ResponseMessage::ACCESS_DENIED_MESSAGE;
                                }
                            } else {
                                $responseCode = ResponseCode::OBJECT_DOES_NOT_EXIST;
                                $message = "SERV: " . sprintf(ResponseMessage::OBJECT_DOES_NOT_EXIST_MESSAGE, 'admin');
                            }
                        } else {
                            $responseCode = ResponseCode::INPUT_EMPTY;
                            $message = "SERV: " . sprintf(ResponseMessage::INPUT_EMPTY_MESSAGE, "tin tức");
                        }
                    }
                } else {
                    $responseCode = ResponseCode::ACCESS_DENIED;
                    $message = "SERV2: " . ResponseMessage::ACCESS_DENIED_MESSAGE . " 1" . $this->check_admin_role(Enum::ROLE_MANAGER) . " 2" . $this->check_admin() . " 3" . $this->check_login();
                }
            } else {
                $responseCode = ResponseCode::REQUEST_INVALID;
                $message = "SERV: " . sprintf(ResponseMessage::REQUEST_INVALID_MESSAGE);
            }
        } catch (Exception $e) {
            $responseCode = ResponseCode::UNKNOWN_ERROR;
            $message = "SERV: " . $e->getMessage();
        }
        $this->response($responseCode, $message, $data);
    }
}
