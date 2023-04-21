<?php 
class AppointmentController extends BaseController{

    public function appointment_page(){
        $this->renderView(
            'booking',[]
        );
    }

}