<?php 
class HomeController extends BaseController{

    public function index(){
        $this->renderView(
            'index',[]
        );
    }
    public function login(){
        $this->renderView('login');
    }
}