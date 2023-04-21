<?php 
class AppointmentController extends BaseController{

    public function appointment_page(){
 //       if (isset($_SESSION['login']) && $_SESSION['login']){
            $this->renderView(
                'booking',[]
            );
        // } else {
        //     $this->redirect('home','login');
        // }
    }

}