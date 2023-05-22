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
                $this->render_error('403');
            }
        } else {
            $this->render_error('400');
        }
    }

    public function appointment_page_ad()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->check_admin() && ($this->check_admin_role(Enum::ROLE_MANAGER) || $this->check_admin_role(Enum::ROLE_SALE))) {
                $this->render_view(
                    'appointment'
                );
            } else $this->render_error('403');
        } else $this->render_error('400');
    }

    public function booking()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        try {
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
                                    $back = substr($_POST['apmTime'], $pos + 1);
                                    $time = substr($_POST['apmTime'], 0, $pos) . ":00";
                                    $date = date("Y/m/d", strtotime($_POST['apmDate']));
                                    $dt = new DateTime("now", new DateTimeZone('Asia/Saigon'));
                                    $dateTimeToday = $dt->setTimestamp(time())->format('Y/m/d H:i:s');
                                    $dateTimeBooking = $date . " " . $time;
                                    if ($back == 'PM') $dateTimeBooking = strtotime($dateTimeBooking) + 43200;
                                    else $dateTimeBooking = strtotime($dateTimeBooking);
                                    if ($dateTimeBooking - 7000 >= strtotime($dateTimeToday)) {
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
        } catch (Exception $e) {
            $responseCode = ResponseCode::UNKNOWN_ERROR;
            $message = "SERV: " . $e->getMessage();
        }
        $this->response($responseCode, $message, $data);
    }


    public function data_customer_current_apm()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        try {
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
                            $message = "SERV: " . sprintf(ResponseMessage::SELECT_MESSAGE, 'lịch đang hẹn', 'thành công');
                            $data = [
                                'appointment' => $appointment
                            ];
                        } else {
                            $responseCode = ResponseCode::DATA_EMPTY;
                            $message = "SERV: " . sprintf(ResponseMessage::DATA_EMPTY_MESSAGE, 'lịch đang hẹn');
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
        } catch (Exception $e) {
            $responseCode = ResponseCode::UNKNOWN_ERROR;
            $message = "SERV: " . $e->getMessage();
        }
        $this->response($responseCode, $message, $data);
    }

    public function cancel_appointment()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        try {
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
                            $appointment = $appointmentModel->get_by_id($idApm);
                            if ($appointment['apm_status'] == Enum::STATUS_APPOINTMENT_CONFIRMED_NO) {
                                if ($appointmentModel->cancel_appointment($idApm, $idCtm)) {
                                    $responseCode = ResponseCode::SUCCESS;
                                    $message = "SERV: " . sprintf(ResponseMessage::UPDATE_MESSAGE, 'lịch đang hẹn', 'thành công');
                                } else {
                                    $message = "SERV: " . sprintf(ResponseMessage::UPDATE_MESSAGE, 'lịch đang hẹn', 'thất bại');
                                }
                            } else {
                                $message = "SERV: Lịch hẹn đã xác nhận, không thể huỷ.";
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
        } catch (Exception $e) {
            $responseCode = ResponseCode::UNKNOWN_ERROR;
            $message = "SERV: " . $e->getMessage();
        }
        $this->response($responseCode, $message, $data);
    }

    public function data_appointment(){
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                // if ($this->check_admin() && $this->check_admin_role(Enum::ROLE_MANAGER)) {
                //     $token = $_GET['token'] != null ? $_GET['token'] : '';
                //     $data = $this->verify_and_decode_token($token);
                //     if (!$data) {
                //         $responseCode = ResponseCode::TOKEN_INVALID;
                //         $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE;
                //     } else {
                //         $id = json_decode($data)->{'id'};
                //         $role = json_decode($data)->{'role'};
                        $appointmentModel = $this->get_model('appointment');
                //        $admin = $adminModel->get_by_id($id);
                        // if ($role == Enum::ROLE_MANAGER && $role == $admin['ad_role']) {
                            $appointments = $appointmentModel->get_data(" order by apm_booking_at DESC");
                            if ($appointments != null) {
                                $responseCode = ResponseCode::SUCCESS;
                                $message = "SERV: " . sprintf(ResponseMessage::SELECT_MESSAGE, 'lịch hẹn', 'thành công');
                                $data = [
                                    'appointments' => $appointments
                                ];
                            } else {
                                $responseCode = ResponseCode::OBJECT_DOES_NOT_EXIST;
                                $message = "SERV: " . sprintf(ResponseMessage::OBJECT_DOES_NOT_EXIST_MESSAGE, 'lịch hẹn');
                            }
                //         } else {
                //             $responseCode = ResponseCode::ACCESS_DENIED;
                //             $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE;
                //         }
                //     }
                // } else {
                //     $responseCode = ResponseCode::ACCESS_DENIED;
                //     $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE;
                // }
            } else {
                $responseCode = ResponseCode::REQUEST_INVALID;
                $message = "SERV: " . sprintf(ResponseMessage::REQUEST_INVALID_MESSAGE);
            }
        } catch (Exception $e) {
            $responseCode = ResponseCode::UNKNOWN_ERROR;
            $message = "SERV: " . $e->getMessage();
        }
        $this->response($responseCode, $message, $data);
    }
}
