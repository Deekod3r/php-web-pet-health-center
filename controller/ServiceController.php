<?php 
class ServiceController extends BaseController{

    public function service_page(){
        $this->renderView(
            'service',[]
        );
    }

}