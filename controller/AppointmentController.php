<?php
class AppointmentController extends BaseController
{

    public function appointment_page()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->render_view(
                'booking',
            );
        } else include('view/error/error-400.php');
    }


    public function booking()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->check_login()) {
                $token = $_POST['token'] != null ? $_POST['token'] : '';
                $data = $this->verify_and_decode_token($token);
                if (!$data) {
                    $this->redirect('home', 'index');
                } else {
                    $id = json_decode($data)->{'id'};
                    $appointmentModel = $this->get_model('appointment');
                    $countCurrentApm = count($appointmentModel->get_by_customer($id," and apm_status in (".Enum::STATUS_APPOINTMENT_CONFIRMED_YES.",".Enum::STATUS_APPOINTMENT_CONFIRMED_NO.")"));
                    if ($countCurrentApm <= 3) {
                        $pos = strripos($_POST['apmTime'], " ");
                        $data = [
                            'ctmId' => $id,
                            'date' => date("Y/m/d", strtotime($_POST['apmDate'])),
                            'time' => substr($_POST['apmTime'], 0, $pos),
                            'categoryService' => $_POST['categoryService'],
                            'note' => $_POST['apmNote']
                        ];
                        if ($appointmentModel->save_data($data)) {
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
                    } else {
                        $result = [
                            "statusCode" => "0",
                            "message" => "Không để đặt lịch, bạn đang có quá nhiều lịch hẹn.",
                            "data" => []
                        ];
                        echo json_encode($result);
                    }
                }
            } else {
                $result = [
                    "statusCode" => "0",
                    "message" => "Vui lòng đăng nhập để đặt lịch.",
                    "data" => []
                ];
                echo json_encode($result);
            }
        } else include('view/error/error-400.php');
    }

    public function customer_current_apm()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->check_login()) {
                $this->render_view(
                    'customer_current_apm'
                );
            } else $this->redirect('home', 'index');
        } else include('view/error/error-400.php');
    }

    public function data_customer_current_apm()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->check_login()) {
                $token = $_GET['token'] != null ? $_GET['token'] : '';
                $data = $this->verify_and_decode_token($token);
                if (!$data) {
                    $this->redirect('home', 'index');
                } else {
                    $id = json_decode($data)->{'id'};
                    $appointmentModel = $this->get_model('appointment');
                    $appointment = $appointmentModel->get_by_customer($id, " and ( apm_status in (" . Enum::STATUS_APPOINTMENT_CONFIRMED_YES . " ," . Enum::STATUS_APPOINTMENT_CONFIRMED_NO . ")) ORDER BY apm_date,apm_time");
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
            if ($this->check_login()) {
                if (isset($_POST['id_apm']) && $_POST['id_apm'] != '' && isset($_POST['token']) && $_POST['token'] != '') {
                    $token = $_POST['token'] != null ? $_POST['token'] : '';
                    $data = $this->verify_and_decode_token($token);
                    if (!$data) {
                        $this->redirect('home', 'index');
                    } else {
                        $idApm = $_POST['id_apm'];
                        $idCtm = json_decode($data)->{'id'};
                        $appointmentModel = $this->get_model('appointment');
                        if ($appointmentModel->cancel_appointment($idApm, $idCtm)) {
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
