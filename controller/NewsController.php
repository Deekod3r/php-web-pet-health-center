<?php 
class NewsController extends BaseController{

    public function news_page(){
        if (isset($_GET['key']) and $_GET['key'] != '') {
            $key = "and concat(news_title, news_content, news_description) like '%" . $_GET['key'] . "%'";
        } else $key = "";
        $shopRepo = $this->getRepo('shop');
        $shop = $shopRepo->getData("");
        $newsRepo = $this->getRepo('news');
        $news = $newsRepo->getData($key,0);
        $categoryNewsRepo = $this->getRepo('categorynews');
        $categoryNews = $categoryNewsRepo->getData("");
        $this->renderView(
            'blog',[
                'shop' => $shop,
                'categoryNews' => $categoryNews,
                'news' => $news
            ]
        );
    }

    public function detail_news(){
        if (isset($_GET['id']) and $_GET['id'] != '') {
            $id = $_GET['id'];
            $newsRepo = $this->getRepo('news');
            $news = $newsRepo->getById($id);
            $recentNews =  $newsRepo->getData("",3);
            $shopRepo = $this->getRepo('shop');
            $shop = $shopRepo->getData("");
            $categoryNewsRepo = $this->getRepo('categorynews');
            $categoryNews = $categoryNewsRepo->getData("");
            $this->renderView(
                'single',[
                    'shop' => $shop,
                    'categoryNews' => $categoryNews,
                    'news' => $news,
                    'recentNews' => $recentNews
                ]
            );
        } else $this->redirect('news','news_page');
    }

}