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
                                if ($countCurrentApm <= 2 || $countCurrentApm == null) {
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
                                            'time' => date("H:i", strtotime($time . " " . $back)),
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
                        $appointments = $appointmentModel->get_by_customer($id, " and ( apm_status in (" . Enum::STATUS_APPOINTMENT_CONFIRMED_YES . " ," . Enum::STATUS_APPOINTMENT_CONFIRMED_NO . ")) ORDER BY apm_date,apm_time");
                        if ($appointments != null) {
                            $responseCode = ResponseCode::SUCCESS;
                            $message = "SERV: " . sprintf(ResponseMessage::SELECT_MESSAGE, 'lịch đang hẹn', 'thành công');
                            $data = [
                                'appointments' => $appointments
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

    public function data_appointment()
    {
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

                //        $admin = $adminModel->get_by_id($id);
                // if ($role == Enum::ROLE_MANAGER && $role == $admin['ad_role']) {
                $key = '';
                $limit = 0;
                $offset = 0;
                $appointmentModel = $this->get_model('appointment');
                if (isset($_GET['ctmPhone']) and $_GET['ctmPhone'] != '') {
                    $key .= "ctm_phone like '%" . $_GET['ctmPhone'] . "%'";
                }
                if (isset($_GET['apmDate']) and $_GET['apmDate'] != '') {
                    if ($key != '') {
                        $key .= ' and ';
                    }
                    $key .= " apm_date = '" . $_GET['apmDate'] . "'";
                }
                if (isset($_GET['apmMonth']) and $_GET['apmMonth'] != '') {
                    if ($key != '') {
                        $key .= ' and ';
                    }
                    $key .= " month(apm_date) = " . $_GET['apmMonth'];
                }
                if (isset($_GET['apmYear']) and $_GET['apmYear'] != '') {
                    if ($key != '') {
                        $key .= ' and ';
                    }
                    $key .= " year(apm_date) = " . $_GET['apmYear'];
                }
                if (isset($_GET['apmStatus']) and $_GET['apmStatus'] != '') {
                    if ($key != '') {
                        $key .= ' and ';
                    }
                    $key .= " apm_status = " . $_GET['apmStatus'];
                }
                if ($key != '') $key = "where " . $key;
                // $message = "SERV: " . $key;
                // $data = $_GET;
                $data[] = $key;
                $count = $appointmentModel->count_data($key);
                if ($count > 0) {
                    $key .= " order by apm_status desc, apm_date asc, apm_time asc, apm_booking_at desc";
                    if (isset($_GET['limit']) and $_GET['limit'] != '') {
                        $limit = $_GET['limit'];
                        if ($limit > 0) {
                            $key .= " limit " . $limit;
                            if (isset($_GET['index']) and $_GET['index'] != '') {
                                $index = $_GET['index'];
                                if ($index > 1) {
                                    $offset = ($index - 1) * $limit;
                                }
                                if ($offset > 0) {
                                    $key .= " offset " . $offset;
                                }
                            }
                        }
                    }
                    $appointments = $appointmentModel->get_data($key);
                    if ($appointments != null) {
                        $responseCode = ResponseCode::SUCCESS;
                        $message = "SERV: " . sprintf(ResponseMessage::SELECT_MESSAGE, 'lịch hẹn', 'thành công');
                        $data = [
                            'appointments' => $appointments,
                            'count' => $count,
                            'status' => $_GET['apmStatus']
                        ];
                    } else {
                        $responseCode = ResponseCode::OBJECT_DOES_NOT_EXIST;
                        $message = "SERV: " . sprintf(ResponseMessage::OBJECT_DOES_NOT_EXIST_MESSAGE, 'lịch hẹn');
                    }
                } else {
                    $responseCode = ResponseCode::DATA_EMPTY;
                    $message = "SERV: " . sprintf(ResponseMessage::DATA_EMPTY_MESSAGE, "dịch vụ");
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

    public function data_detail_appointment()
    {
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
                //        $admin = $adminModel->get_by_id($id);
                // if ($role == Enum::ROLE_MANAGER && $role == $admin['ad_role']) {
                if (isset($_GET['appointmentId']) && $_GET['appointmentId'] != '') {
                    $appointmentModel = $this->get_model('appointment');
                    $appointment = $appointmentModel->get_by_id($_GET['appointmentId']);
                    if ($appointment != null) {
                        $responseCode = ResponseCode::SUCCESS;
                        $message = "SERV: " . sprintf(ResponseMessage::SELECT_MESSAGE, 'lịch hẹn', 'thành công');
                        $data = [
                            'appointment' => $appointment
                        ];
                    } else {
                        $responseCode = ResponseCode::OBJECT_DOES_NOT_EXIST;
                        $message = "SERV: " . sprintf(ResponseMessage::OBJECT_DOES_NOT_EXIST_MESSAGE, 'lịch hẹn');
                    }
                } else {
                    $responseCode = ResponseCode::INPUT_EMPTY;
                    $message = "SERV: " . sprintf(ResponseMessage::INPUT_EMPTY_MESSAGE, "lịch hẹn");
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

    public function edit_appointment()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($this->check_admin() && ($this->check_admin_role(Enum::ROLE_MANAGER) || $this->check_admin_role(Enum::ROLE_SALE))) {
                    $token = isset($_POST['token']) && $_POST['token'] != null ? $_POST['token'] : '';
                    $dataToken = $this->verify_and_decode_token($token);
                    if (!$dataToken) {
                        $responseCode = ResponseCode::TOKEN_INVALID;
                        $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE . " token:" . $token;
                    } else {
                        if (isset($_POST['appointmentIdEdit']) && $_POST['appointmentIdEdit'] != '' && isset($_POST['appointmentStatusEdit']) && $_POST['appointmentStatusEdit'] != '') {
                            //&& isset($_FILES["svImg"]) && !$_FILES["svImg"]["name"] != ''
                            $id = json_decode($dataToken)->{'id'};
                            $admin = $this->get_model('admin')->get_by_id($id);
                            if ($admin != null) {
                                //$img = $_FILES["svImg"];
                                //if ($this->save_img(ServiceController::PATH_IMG_SERVICE,$img)) {
                                $dataappointment = [
                                    'apm_status' => $_POST['appointmentStatusEdit']
                                ];
                                $appointmentModel = $this->get_model('appointment');
                                if ($appointmentModel->update_data($dataappointment, $_POST['appointmentIdEdit'])) {
                                    $responseCode = ResponseCode::SUCCESS;
                                    $message = "SERV: " . sprintf(ResponseMessage::UPDATE_MESSAGE, "lịch hẹn", "thành công");
                                } else {
                                    $message = "SERV: " . sprintf(ResponseMessage::UPDATE_MESSAGE, "lịch hẹn", "thất bại");
                                }
                                //} else {
                                //    $message = "SERV: " . sprintf(ResponseMessage::INSERT_MESSAGE,"ảnh dịch vụ","thất bại");
                                //}
                            } else {
                                $responseCode = ResponseCode::OBJECT_DOES_NOT_EXIST;
                                $message = "SERV: " . sprintf(ResponseMessage::OBJECT_DOES_NOT_EXIST_MESSAGE, 'admin');
                            }
                        } else {
                            $responseCode = ResponseCode::INPUT_EMPTY;
                            $message = "SERV: " . sprintf(ResponseMessage::INPUT_EMPTY_MESSAGE, "lịch hẹn");
                        }
                    }
                } else {
                    $responseCode = ResponseCode::ACCESS_DENIED;
                    $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE;
                }
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

    public function add_appointment()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] =  null;
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($this->check_admin() && ($this->check_admin_role(Enum::ROLE_MANAGER) || $this->check_admin_role(Enum::ROLE_SALE))) {
                    $token = isset($_POST['token']) && $_POST['token'] != null ? $_POST['token'] : '';
                    $dataToken = $this->verify_and_decode_token($token);
                    if (!$dataToken) {
                        $responseCode = ResponseCode::TOKEN_INVALID;
                        $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE . " token:" . $token;
                    } else {
                        if (isset($_POST['apmDate']) && $_POST['apmDate'] != '' && isset($_POST['apmTime']) && $_POST['apmTime'] != '' && isset($_POST['apmNote']) && isset($_POST['ctmPhone']) && $_POST['ctmPhone'] != '' && isset($_POST['categoryService']) && $_POST['categoryService'] != '') {
                            $id = json_decode($dataToken)->{'id'};
                            $admin = $this->get_model('admin')->get_by_id($id);
                            if ($admin != null) {
                                $customerModel = $this->get_model('customer');
                                $appointmentModel = $this->get_model('appointment');
                                $customer = $customerModel->get_data("where ctm_phone = '" . $_POST['ctmPhone'] . "'");
                                if ($customer != null) {
                                    $customer = $customer[0];
                                    $countCurrentApm = $appointmentModel->get_by_customer($customer['ctm_id'], " and apm_status in (" . Enum::STATUS_APPOINTMENT_CONFIRMED_YES . "," . Enum::STATUS_APPOINTMENT_CONFIRMED_NO . ")") != null ? count($appointmentModel->get_by_customer($customer['ctm_id'], " and apm_status in (" . Enum::STATUS_APPOINTMENT_CONFIRMED_YES . "," . Enum::STATUS_APPOINTMENT_CONFIRMED_NO . ")")) : 0;
                                    if ($countCurrentApm <= 2) {
                                        //$data = $_POST;
                                        $time = $_POST['apmTime'] . ":00";
                                        $date = date("Y/m/d", strtotime($_POST['apmDate']));
                                        $dt = new DateTime("now", new DateTimeZone('Asia/Saigon'));
                                        $dateTimeToday = $dt->setTimestamp(time())->format('Y/m/d H:i:s');
                                        $dateTimeBooking = $date . " " . $time;
                                        if (strtotime($dateTimeBooking) - 7000 >= strtotime($dateTimeToday)) {
                                            $dataBooking = [
                                                'ctmId' => $customer['ctm_id'],
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
                                        $message = "SERV: " . "Khách hàng đang có quá nhiều lịch hẹn, vui lòng đặt lịch sau.";
                                    }
                                } else {
                                    $responseCode = ResponseCode::OBJECT_DOES_NOT_EXIST;
                                    $message = "SERV: " . sprintf(ResponseMessage::OBJECT_DOES_NOT_EXIST_MESSAGE, 'khách hàng');
                                }
                            } else {
                                $responseCode = ResponseCode::OBJECT_DOES_NOT_EXIST;
                                $message = "SERV: " . sprintf(ResponseMessage::OBJECT_DOES_NOT_EXIST_MESSAGE, 'admin');
                            }
                        } else {
                            $responseCode = ResponseCode::INPUT_EMPTY;
                            $message = "SERV: " . sprintf(ResponseMessage::INPUT_EMPTY_MESSAGE, "mã giảm giá");
                        }
                    }
                } else {
                    $responseCode = ResponseCode::ACCESS_DENIED;
                    $message = "SERV2: " . ResponseMessage::ACCESS_DENIED_MESSAGE;
                }
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

    public function data_statistic_appointment()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $appointmentModel = $this->get_model('appointment');
                $count = $appointmentModel->count_data("");
                if ($count > 0) {
                    $appointments = $appointmentModel->native_query("select month(apm_booking_at) as month, count(apm_id) as appointments from appointment
                    where month(apm_booking_at) <= month(now()) and year(apm_booking_at) = year(now()) and apm_status = 1
                    group by month(apm_booking_at)");
                    $responseCode = ResponseCode::SUCCESS;
                    $message = "SERV: " . sprintf(ResponseMessage::SELECT_MESSAGE, "lịch hẹn", "thành công.");
                    $data = [
                        'appointments' => $appointments,
                        //'count' => $count
                    ];
                } else {
                    $responseCode = ResponseCode::DATA_EMPTY;
                    $message = "SERV: " . sprintf(ResponseMessage::DATA_EMPTY_MESSAGE, "lịch hẹn");
                }
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

    public function new_appointment()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $appointmentModel = $this->get_model('appointment');
                $count = $appointmentModel->count_data("");
                if ($count > 0) {
                    $newAppointment = $appointmentModel->native_query("select count(apm_id) as count from appointment where apm_status = " . Enum::STATUS_APPOINTMENT_CONFIRMED_NO);
                    $responseCode = ResponseCode::SUCCESS;
                    $message = "SERV: " . sprintf(ResponseMessage::SELECT_MESSAGE, "lịch hẹn", "thành công.");
                    $data = [
                        'newAppointment' => $newAppointment[0]['count'],
                        //'count' => $count
                    ];
                } else {
                    $responseCode = ResponseCode::DATA_EMPTY;
                    $message = "SERV: " . sprintf(ResponseMessage::DATA_EMPTY_MESSAGE, "lịch hẹn");
                }
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
