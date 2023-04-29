<?php 
class AppointmentController extends BaseController{

    public function appointment_page(){
        $shopRepo = $this->getRepo('shop');
        $shop = $shopRepo->getData();
        $this->renderView(
            'booking',[
            'shop' => $shop
        ]
        );
    }

}