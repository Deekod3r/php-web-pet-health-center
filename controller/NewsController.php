<?php 
class NewsController extends BaseController{

    public function news_page(){
        $this->renderView(
            'blog',[]
        );
    }

}