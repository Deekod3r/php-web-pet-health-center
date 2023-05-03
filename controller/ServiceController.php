<?php 
class ServiceController extends BaseController{

    public function service_page(){
        if (isset($_GET['sv_name']) and $_GET['sv_name'] != '') {
            $key = "and sv_name like '%" . $_GET['sv_name'] . "%'";
        } else $key = "";
        $serviceRepo = $this->getRepo('service');
        $service = $serviceRepo->getData($key);
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