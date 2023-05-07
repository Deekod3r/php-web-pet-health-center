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

    
    public function booking(){
        $pos = strripos($_POST['apmTime']," ");
        //echo $pos;
        $data = [
            'ctmId' => $_POST['ctmId'],
            'date' => date("Y/m/d",strtotime($_POST['apmDate'])),
            'time' => substr($_POST['apmTime'],0,$pos),
            'categoryService' =>$_POST['categoryService'],
            'note' => $_POST['apmNote']
        ];
        //var_dump($data);
        $appointmentRepo = $this->getRepo('appointment');
        if ($appointmentRepo->saveData($data)) {
            $_SESSION['msg_booking'] = "Đặt lịch thành công.";
            $_SESSION['check_booking'] = true;
        } else {
            $_SESSION['msg_booking'] = "Đặt lịch không thành công.";
            $_SESSION['check_booking'] = false;
        }
        $this->redirect('appointment','appointment_page');
    }

    public function customer_current_apm(){
        $shopRepo = $this->getRepo('shop');
        $shop = $shopRepo->getData("");
        $appointmentRepo = $this->getRepo('appointment');
        $appointment = $appointmentRepo->getByCustomer($_SESSION['id']," and ( apm_status in (".Enum::STATUS_APPOINTMENT_CONFIRMED_YES ." ,".Enum::STATUS_APPOINTMENT_CONFIRMED_NO.")) ORDER BY apm_date,apm_time");
        $this->renderView(
            'customer_current_apm',[
                'shop' => $shop,
                'appointment' => $appointment
            ]
        );
    }

    public function cancel_appointment(){
        if (isset($_GET['id_apm']) and $_GET['id_apm'] != '' and isset($_GET['id_ctm']) and $_GET['id_ctm'] != '') {
            $idApm = $_GET['id_apm'];
            $idCtm = $_GET['id_ctm'];
            $appointmentRepo = $this->getRepo('appointment');
            if ($appointmentRepo->cancelApm($idApm,$idCtm)) {
                $_SESSION['msg_cancel_apm'] = "Huỷ thành công.";
                $_SESSION['check_cancel_apm'] = true;
            } else {
                $_SESSION['msg_cancel_apm'] = "Huỷ không thành công.";
                $_SESSION['check_cancel_apm'] = false;
            }
        } 
        $this->redirect('appointment','customer_current_apm');
    }
}