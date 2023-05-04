<?php 
class AppointmentController extends BaseController{

    public function appointment_page(){
        $shopRepo = $this->getRepo('shop');
        $shop = $shopRepo->getData("");
        $categoryServiceRepo = $this->getRepo('categoryservice');
        $categoryService = $categoryServiceRepo->getData("");
        $this->renderView(
            'booking',[
            'shop' => $shop,
            'categoryService' => $categoryService
            ]
        );
    }

}