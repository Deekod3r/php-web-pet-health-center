<?php
class AppointmentController extends BaseController
{

    public function appointment_page()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->renderView(
                'booking',
            );
        } else include('view/error/error-400.php');
    }


    public function booking()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->checkLogin()) {
                $token = $_POST['token'] != null ? $_POST['token'] : '';
                $data = $this->verify_and_decode_token($token);
                if (!$data) {
                    $this->redirect('home', 'index');
                } else {
                    $id = json_decode($data)->{'id'};
                    $pos = strripos($_POST['apmTime'], " ");
                    $data = [
                        'ctmId' => $id,
                        'date' => date("Y/m/d", strtotime($_POST['apmDate'])),
                        'time' => substr($_POST['apmTime'], 0, $pos),
                        'categoryService' => $_POST['categoryService'],
                        'note' => $_POST['apmNote']
                    ];
                    $appointmentRepo = $this->getRepo('appointment');
                    if ($appointmentRepo->saveData($data)) {
                        $result = [
                            "statusCode" => "1",
                            "message" => "Đặt lịch thành công.",
                            "data" => []
                        ];
                        echo json_encode($result);
                    } else {
                        $result = [
                            "statusCode" => "0",
                            "message" => "Đặt lịch thất bại.",
                            "data" => []
                        ];
                        echo json_encode($result);
                    }
                }
            } else {
                $result = [
                    "statusCode" => "0",
                    "message" => "Đặt lịch thất bại.",
                    "data" => []
                ];
                echo json_encode($result);
            }
        } else include('view/error/error-400.php');
    }

    public function customer_current_apm()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->checkLogin()) {
                $this->renderView(
                    'customer_current_apm'
                );
            } else $this->redirect('home', 'index');
        } else include('view/error/error-400.php');
    }

    public function data_customer_current_apm()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->checkLogin()) {
                $token = $_GET['token'] != null ? $_GET['token'] : '';
                $data = $this->verify_and_decode_token($token);
                if (!$data) {
                    $this->redirect('home', 'index');
                } else {
                    $id = json_decode($data)->{'id'};
                    $appointmentRepo = $this->getRepo('appointment');
                    $appointment = $appointmentRepo->getByCustomer($id, " and ( apm_status in (" . Enum::STATUS_APPOINTMENT_CONFIRMED_YES . " ," . Enum::STATUS_APPOINTMENT_CONFIRMED_NO . ")) ORDER BY apm_date,apm_time");
                    $result = [
                        "statusCode" => "1",
                        "message" => "OK",
                        "data" => [
                            'appointment' => $appointment
                        ]
                    ];
                    echo json_encode($result);
                }
            } else $this->redirect('home', 'index');
        } else include('view/error/error-400.php');
    }

    public function cancel_appointment()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->checkLogin()) {
                if (isset($_POST['id_apm']) && $_POST['id_apm'] != '' && isset($_POST['token']) && $_POST['token'] != '') {
                    $token = $_POST['token'] != null ? $_POST['token'] : '';
                    $data = $this->verify_and_decode_token($token);
                    if (!$data) {
                        $this->redirect('home', 'index');
                    } else {
                        $idApm = $_POST['id_apm'];
                        $idCtm = json_decode($data)->{'id'};
                        $appointmentRepo = $this->getRepo('appointment');
                        if ($appointmentRepo->cancelApm($idApm, $idCtm)) {
                            $result = [
                                "statusCode" => "1",
                                "message" => "Huỷ lịch hẹn thành công. ",
                                "data" => []
                            ];
                        } else {
                            $result = [
                                "statusCode" => "0",
                                "message" => "Huỷ lịch hẹn thất bại. ",
                                "data" => []
                            ];
                        }
                        echo json_encode($result);
                    }
                }
            } else $this->redirect('home', 'index');
        } else include('view/error/error-400.php');
    }
}
