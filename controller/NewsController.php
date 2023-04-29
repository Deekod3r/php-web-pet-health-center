<?php 
class NewsController extends BaseController{

    public function news_page(){
        $shopRepo = $this->getRepo('shop');
        $shop = $shopRepo->getData();
        $newsRepo = $this->getRepo('news');
        $news = $newsRepo->getData();
        $categoryNewsRepo = $this->getRepo('categorynews');
        $categoryNews = $categoryNewsRepo->getData();
        $this->renderView(
            'blog',[
                'shop' => $shop,
                'categoryNews' => $categoryNews
            ]
        );
    }

}