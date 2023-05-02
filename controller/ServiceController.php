<?php 
class ServiceController extends BaseController{

    public function service_page(){
        if (isset($_GET['key']) and $_GET['key'] != '') {
            $key = "where concat()";
        }
        $serviceRepo = $this->getRepo('service');
        $service = $serviceRepo->getData("");
        $shopRepo = $this->getRepo('shop');
        $shop = $shopRepo->getData("");
        $categoryServiceRepo = $this->getRepo('categoryservice');
        $categoryService = $categoryServiceRepo->getData("");
        $this->renderView(
            'service',[
                'shop' => $shop,
                'service' => $service,
                'categoryService' => $categoryService
            ]
        ); 
    }

}