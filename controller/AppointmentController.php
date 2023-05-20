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

    public function customer_current_apm()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->check_login()) {
                $this->render_view(
                    'customer-current-apm'
                );
            } else {
                $this->redirect('home', 'index');
            }
        } else {
            include 'view/error/error-400.php';
        }

    }
    
    public function booking()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->check_login()) {
                $token = $_POST['token'] != null ? $_POST['token'] : '';
                $dataToken = $this->verify_and_decode_token($token);
                if (!$dataToken) {
                    $responseCode = ResponseCode::ACCESS_DENIED;
                    $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE;
                } else {
                    if ($_POST['apmDate'] != null && $_POST['apmDate'] != '' && $_POST['categoryService'] != null && $_POST['categoryService'] != '' && $_POST['apmTime'] != null && $_POST['apmTime'] != '') {
                        $id = json_decode($dataToken)->{'id'};
                        $role = json_decode($dataToken)->{'role'};
                        $customerModel = $this->get_model('customer');
                        if ($customerModel->get_by_id($id) != null && $role == -1) {
                            $appointmentModel = $this->get_model('appointment');
                            $countCurrentApm = count($appointmentModel->get_by_customer($id, " and apm_status in (" . Enum::STATUS_APPOINTMENT_CONFIRMED_YES . "," . Enum::STATUS_APPOINTMENT_CONFIRMED_NO . ")"));
                            if ($countCurrentApm <= 2) {
                                $pos = strripos($_POST['apmTime'], " ");
                                $back = substr($_POST['apmTime'],$pos+1);
                                $time = substr($_POST['apmTime'], 0, $pos) . ":00";
                                $date = date("Y/m/d", strtotime($_POST['apmDate']));
                                $dt = new DateTime("now", new DateTimeZone('Asia/Saigon'));
                                $dateTimeToday = $dt->setTimestamp(time())->format('Y/m/d H:i:s');
                                $dateTimeBooking = $date." ".$time;
                                if ($back == 'PM') $dateTimeBooking = strtotime($dateTimeBooking) + 43200;
                                else $dateTimeBooking = strtotime($dateTimeBooking);
                                if ($dateTimeBooking - 7200 >= strtotime($dateTimeToday)) {
                                    $dataBooking = [
                                        'ctmId' => $id,
                                        'date' => $date,
                                        'time' => $time,
                                        'categoryService' => $_POST['categoryService'],
                                        'note' => $_POST['apmNote'],
                                    ];
                                    if ($appointmentModel->save_data($dataBooking)) {
                                        $responseCode = ResponseCode::SUCCESS;
                                        $message = "SERV: " . sprintf(ResponseMessage::INSERT_MESSAGE, "lịch hẹn", "thành công");
                                    } else {
                                        $responseCode = ResponseCode::FAIL;
                                        $message = "SERV: " . sprintf(ResponseMessage::INSERT_MESSAGE, "lịch hẹn", "thất bại");
                                    }
                                } else {
                                    $responseCode = ResponseCode::INPUT_INVALID_TYPE;
                                    $message = "SERV: " . "Lịch hẹn cần đặt tối thiểu trước 2 tiếng.";
                                }
                            } else {
                                $responseCode = ResponseCode::FAIL;
                                $message = "SERV: " . "Bạn đang có quá nhiều lịch hẹn, vui lòng đặt lịch sau.";
                            }
                        } else {
                            $responseCode = ResponseCode::TOKEN_INVALID;
                            $message = "SERV: " . ResponseMessage::REQUEST_INVALID_MESSAGE;
                        }
                    } else {
                        $responseCode = ResponseCode::INPUT_EMPTY;
                        $message = "SERV: " . sprintf(ResponseMessage::INPUT_EMPTY_MESSAGE, "lịch hẹn");
                    }
                }
            } else {
                $responseCode = ResponseCode::ACCESS_DENIED;
                $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE . "Vui lòng đăng nhập.";
            }
        } else {
            $responseCode = ResponseCode::REQUEST_INVALID;
            $message = "SERV: " . ResponseMessage::REQUEST_INVALID_MESSAGE;
        }
        $this->response($responseCode, $message, $data);
    }


    public function data_customer_current_apm()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->check_login()) {
                $token = $_GET['token'] != null ? $_GET['token'] : '';
                $data = $this->verify_and_decode_token($token);
                if (!$data) {
                    $responseCode = ResponseCode::ACCESS_DENIED;
                    $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE;
                } else {
                    $id = json_decode($data)->{'id'};
                    $appointmentModel = $this->get_model('appointment');
                    $appointment = $appointmentModel->get_by_customer($id, " and ( apm_status in (" . Enum::STATUS_APPOINTMENT_CONFIRMED_YES . " ," . Enum::STATUS_APPOINTMENT_CONFIRMED_NO . ")) ORDER BY apm_date,apm_time");
                    if ($appointment != null) {
                        $responseCode = ResponseCode::SUCCESS;
                        $message = "SERV: " . sprintf(ResponseMessage::SELECT_MESSAGE,'lịch đang hẹn','thành công');
                        $data = [
                            'appointment' => $appointment
                        ];
                    } else {
                        $responseCode = ResponseCode::DATA_EMPTY;
                        $message = "SERV: " . sprintf(ResponseMessage::DATA_EMPTY_MESSAGE,'lịch đang hẹn');
                    }
                }
            } else {
                $responseCode = ResponseCode::ACCESS_DENIED;
                $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE . "Vui lòng đăng nhập.";
            }
        } else {
            $responseCode = ResponseCode::REQUEST_INVALID;
            $message = "SERV: " . ResponseMessage::REQUEST_INVALID_MESSAGE;
        }
        $this->response($responseCode, $message, $data);
    }

    public function cancel_appointment()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->check_login()) {
                if (isset($_POST['idApm']) && $_POST['idApm'] != '' && isset($_POST['token']) && $_POST['token'] != '') {
                    $token = $_POST['token'] != null ? $_POST['token'] : '';
                    $dataToken = $this->verify_and_decode_token($token);
                    if (!$dataToken) {
                        $responseCode = ResponseCode::ACCESS_DENIED;
                        $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE;
                    } else {
                        $idApm = $_POST['idApm'];
                        $idCtm = json_decode($dataToken)->{'id'};
                        $appointmentModel = $this->get_model('appointment');
                        if ($appointmentModel->cancel_appointment($idApm, $idCtm)) {
                            $responseCode = ResponseCode::SUCCESS;
                            $message = "SERV: " . sprintf(ResponseMessage::UPDATE_MESSAGE,'lịch đang hẹn','thành công');
                        } else {
                            $message = "SERV: " . sprintf(ResponseMessage::UPDATE_MESSAGE,'lịch đang hẹn','thất bại');
                        }
                    }
                }
            } else {
                $responseCode = ResponseCode::ACCESS_DENIED;
                $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE . "Vui lòng đăng nhập.";
            }
        } else {
            $responseCode = ResponseCode::REQUEST_INVALID;
            $message = "SERV: " . ResponseMessage::REQUEST_INVALID_MESSAGE;
        }
        $this->response($responseCode, $message, $data);
    }
}
