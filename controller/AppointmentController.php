<?php
class AppointmentController extends BaseController
{

    public function appointment_page()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->render_view(
                'booking',
            );
        } else {
            include 'view/error/error-400.php';
        }

    }

    public function booking()
    {
        $responseCode = ResponseCode::FAIL;
        $message = sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->check_login()) {
                $token = $_POST['token'] != null ? $_POST['token'] : '';
                $data = $this->verify_and_decode_token($token);
                if (!$data) {
                    $responseCode = ResponseCode::ACCESS_DENIED;
                    $message = ResponseMessage::ACCESS_DENIED_MESSAGE;
                } else {
                    if ($_POST['apmDate'] != null && $_POST['apmDate'] != '' && $_POST['categoryService'] != null && $_POST['categoryService'] != '' && $_POST['apmTime'] != null && $_POST['apmTime'] != '') {
                        $id = json_decode($data)->{'id'};
                        $role = json_decode($data)->{'role'};
                        $customerModel = $this->get_model('customer');
                        if ($customerModel->get_by_id($id) != null) {
                            $appointmentModel = $this->get_model('appointment');
                            $countCurrentApm = count($appointmentModel->get_by_customer($id, " and apm_status in (" . Enum::STATUS_APPOINTMENT_CONFIRMED_YES . "," . Enum::STATUS_APPOINTMENT_CONFIRMED_NO . ")"));
                            if ($countCurrentApm <= 2) {
                                $pos = strripos($_POST['apmTime'], " ");
                                $date = date("Y/m/d", strtotime($_POST['apmDate']));
                                $time = substr($_POST['apmTime'], 0, $pos);
                                $dateTimeToday = date("Y/m/d H:i:s");
                                $dateTimeBooking = $date." ".$time;
                                if (strtotime($dateTimeBooking) > strtotime($dateTimeToday)) {
                                    $data = [
                                        'ctmId' => $id,
                                        'date' => $date,
                                        'time' => $time,
                                        'categoryService' => $_POST['categoryService'],
                                        'note' => $_POST['apmNote'],
                                    ];
                                    if ($appointmentModel->save_data($data)) {
                                        $responseCode = ResponseCode::SUCCESS;
                                        $message = sprintf(ResponseMessage::INSERT_MESSAGE, "lịch hẹn", "thành công");
                                    } else {
                                        $responseCode = ResponseCode::FAIL;
                                        $message = sprintf(ResponseMessage::INSERT_MESSAGE, "lịch hẹn", "thất bại");
                                    }
                                } else {
                                    $responseCode = ResponseCode::INPUT_INVALID_TYPE;
                                    $message = sprintf(ResponseMessage::INPUT_INVALID_TYPE_MESSAGE,"thời gian");
                                }
                            } else {
                                $responseCode = ResponseCode::FAIL;
                                $message = "Bạn đang có quá nhiều lịch hẹn, vui lòng đặt lịch sau.";
                            }
                        } else {
                            $responseCode = ResponseCode::TOKEN_INVALID;
                            $message = ResponseMessage::REQUEST_INVALID_MESSAGE;
                        }
                    } else {
                        $responseCode = ResponseCode::INPUT_EMPTY;
                        $message = sprintf(ResponseMessage::INPUT_EMPTY_MESSAGE, "lịch hẹn");
                    }
                }
            } else {
                $responseCode = ResponseCode::ACCESS_DENIED;
                $message = ResponseMessage::ACCESS_DENIED_MESSAGE;
            }
        } else {
            $responseCode = ResponseCode::REQUEST_INVALID;
            $message = ResponseMessage::REQUEST_INVALID_MESSAGE;
        }
        $this->response($responseCode, $message, $data);
    }

    public function customer_current_apm()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->check_login()) {
                $this->render_view(
                    'customer_current_apm'
                );
            } else {
                $this->redirect('home', 'index');
            }

        } else {
            include 'view/error/error-400.php';
        }

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
                            'appointment' => $appointment,
                        ],
                    ];
                    echo json_encode($result);
                }
            } else {
                $this->redirect('home', 'index');
            }

        } else {
            include 'view/error/error-400.php';
        }

    }

    public function cancel_appointment()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->check_login()) {
                if (isset($_POST['idApm']) && $_POST['idApm'] != '' && isset($_POST['token']) && $_POST['token'] != '') {
                    $token = $_POST['token'] != null ? $_POST['token'] : '';
                    $data = $this->verify_and_decode_token($token);
                    if (!$data) {
                        $this->redirect('home', 'index');
                    } else {
                        $idApm = $_POST['idApm'];
                        $idCtm = json_decode($data)->{'id'};
                        $appointmentModel = $this->get_model('appointment');
                        if ($appointmentModel->cancel_appointment($idApm, $idCtm)) {
                            $result = [
                                "responseCode" => "01",
                                "message" => "Huỷ lịch hẹn thành công. ",
                                "data" => [],
                            ];
                        } else {
                            $result = [
                                "responseCode" => "00",
                                "message" => "Huỷ lịch hẹn thất bại. ",
                                "data" => [],
                            ];
                        }
                        echo json_encode($result);
                    }
                }
            } else {
                $this->redirect('home', 'index');
            }

        } else {
            include 'view/error/error-400.php';
        }

    }
}
