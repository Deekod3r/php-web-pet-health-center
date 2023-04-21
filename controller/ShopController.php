<?php 
class ShopController extends BaseController{

    public function about_page(){
        $this->renderView(
            'about',[]
        );
    }

    public function contact_page(){
        $this->renderView(
            'contact',[]
        );
    }

}