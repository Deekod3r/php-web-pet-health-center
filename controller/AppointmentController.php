<?php
class AppointmentController extends BaseController
{

    public function appointment_page()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $shopRepo = $this->getRepo('shop');
            $shop = $shopRepo->getData("");
            $categoryServiceRepo = $this->getRepo('categoryservice');
            $categoryService = $categoryServiceRepo->getData("");
            $this->renderView(
                'booking',
                [
                    'shop' => $shop,
                    'categoryService' => $categoryService
                ]
            );
        } else include('view/error/error-400.php');
    }


    public function booking()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $pos = strripos($_POST['apmTime'], " ");
            $data = [
                'ctmId' => $_POST['ctmId'],
                'date' => date("Y/m/d", strtotime($_POST['apmDate'])),
                'time' => substr($_POST['apmTime'], 0, $pos),
                'categoryService' => $_POST['categoryService'],
                'note' => $_POST['apmNote']
            ];
            $appointmentRepo = $this->getRepo('appointment');
            if ($appointmentRepo->saveData($data)) {
                $_SESSION['msg_booking'] = "Đặt lịch thành công.";
                $_SESSION['check_booking'] = true;
            } else {
                $_SESSION['msg_booking'] = "Đặt lịch không thành công.";
                $_SESSION['check_booking'] = false;
            }
            $this->redirect('appointment', 'appointment_page');
        } else include('view/error/error-400.php');
    }

    public function customer_current_apm()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->checkLogin()) {
                $shopRepo = $this->getRepo('shop');
                $shop = $shopRepo->getData("");
                $appointmentRepo = $this->getRepo('appointment');
                $appointment = $appointmentRepo->getByCustomer($_SESSION['id'], " and ( apm_status in (" . Enum::STATUS_APPOINTMENT_CONFIRMED_YES . " ," . Enum::STATUS_APPOINTMENT_CONFIRMED_NO . ")) ORDER BY apm_date,apm_time");
                $this->renderView(
                    'customer_current_apm',
                    [
                        'shop' => $shop,
                        'appointment' => $appointment
                    ]
                );
            }
        } else include('view/error/error-400.php');
    }

    public function cancel_appointment()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['id_apm']) && $_POST['id_apm'] != '' && isset($_POST['id_ctm']) && $_POST['id_ctm'] != '') {
                $idApm = $_POST['id_apm'];
                $idCtm = $_POST['id_ctm'];
                echo $idApm;
                echo $idCtm;
                $appointmentRepo = $this->getRepo('appointment');
                if ($appointmentRepo->cancelApm($idApm, $idCtm)) {
                    $_SESSION['msg_cancel_apm'] = "Huỷ thành công.";
                    $_SESSION['check_cancel_apm'] = true;
                } else {
                    $_SESSION['msg_cancel_apm'] = "Huỷ không thành công.";
                    $_SESSION['check_cancel_apm'] = false;
                }
            }
            $this->redirect('appointment', 'customer_current_apm');
        } else include('view/error/error-400.php');
    }
}
