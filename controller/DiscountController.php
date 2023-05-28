<?php
class DiscountController extends BaseController
{

    public function discount_page_ad()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->check_admin() && ($this->check_admin_role(Enum::ROLE_MANAGER) || $this->check_admin_role(Enum::ROLE_SALE))) {
                $this->render_view(
                    'discount'
                );
            } else $this->render_error('403');
        } else $this->render_error('400');
    }
    public function discount_page()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->render_view(
                'discount'
            );
        } else $this->render_error('400');
    }
    public function data_discount()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $key = '';
                $limit = 0;
                $offset = 0;
                $discountModel = $this->get_model('discount');
                if (isset($_GET['discountCode']) and $_GET['discountCode'] != '') {
                    $key .= "dc_code like '%" . $_GET['discountCode'] . "%'";
                }
                if (isset($_GET['discountCondition']) and $_GET['discountCondition'] != '') {
                    if ($key != '') {
                        $key .= ' and ';
                    }
                    $key .= " dc_condition <= " . $_GET['discountCondition'];
                }
                if (isset($_GET['discountStatus']) and $_GET['discountStatus'] != '') {
                    if ($key != '') {
                        $key .= ' and ';
                    }
                    $key .= " dc_active = " . $_GET['discountStatus'];
                }
                if (isset($_GET['discountValue']) and $_GET['discountValue'] != '') {
                    if ($key != '') {
                        $key .= ' and ';
                    }
                    $key .= $_GET['discountValue'] . " > 0 ";
                }
                if (isset($_GET['discountMonth']) and $_GET['discountMonth'] != '') {
                    if ($key != '') {
                        $key .= ' and ';
                    }
                    $key .= $_GET['discountMonth'] . " >= month(dc_start_time) and " . $_GET['discountMonth'] . " <= month(dc_end_time) ";
                }
                if (isset($_GET['discountYear']) and $_GET['discountYear'] != '') {
                    if ($key != '') {
                        $key .= ' and ';
                    }
                    $key .= $_GET['discountYear'] . " >= year(dc_start_time) and " . $_GET['discountYear'] . " <= year(dc_end_time) ";
                }
                if (!isset($_SESSION['login']) || (isset($_SESSION['login']) && $_SESSION['login'] != Enum::ADMIN)) {
                    if ($key != '') {
                        $key .= ' and ';
                    }
                    $key .= " dc_active = 1 ";
                }
                if ($key != '') $key = "where " . $key;
                // $message = "SERV: " . $key;
                // $data = $_GET;
                $count = $discountModel->count_data($key);
                if ($count > 0) {
                    $key .= " order by %s dc_active desc, dc_end_time desc, dc_start_time desc";
                    if (isset($_GET['discountQuantity']) && $_GET['discountQuantity'] != '') {
                        $key = sprintf($key, "-dc_quantity " . $_GET['discountQuantity'] . ",");
                    } else $key = sprintf($key, "");
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
                    $discounts = $discountModel->get_data($key);
                    if ($discounts != null) {
                        $responseCode = ResponseCode::SUCCESS;
                        $message = "SERV: " . sprintf(ResponseMessage::SELECT_MESSAGE, 'mã giảm giá', 'thành công');
                        $data = [
                            'discounts' => $discounts,
                            'count' => $count,
                            'key' => $key
                        ];
                    } else {
                        $responseCode = ResponseCode::OBJECT_DOES_NOT_EXIST;
                        $message = "SERV: " . sprintf(ResponseMessage::OBJECT_DOES_NOT_EXIST_MESSAGE, 'mã giảm giá');
                    }
                } else {
                    $responseCode = ResponseCode::DATA_EMPTY;
                    $message = "SERV: " . sprintf(ResponseMessage::DATA_EMPTY_MESSAGE, "dịch vụ");
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

    public function add_discount()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] =  null;
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($this->check_admin() && $this->check_admin_role(Enum::ROLE_MANAGER)) {
                    $token = isset($_POST['token']) && $_POST['token'] != null ? $_POST['token'] : '';
                    $dataToken = $this->verify_and_decode_token($token);
                    if (!$dataToken) {
                        $responseCode = ResponseCode::TOKEN_INVALID;
                        $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE . " token:" . $token;
                    } else {
                        if (isset($_POST['discountCodeAdd']) && $_POST['discountCodeAdd'] != '' && isset($_POST['discountConditionAdd']) && $_POST['discountConditionAdd'] != '' && isset($_POST['discountQuantityAdd']) && isset($_POST['discountStartTimeAdd']) && $_POST['discountStartTimeAdd'] != '' && isset($_POST['discountEndTimeAdd']) && $_POST['discountEndTimeAdd'] != '' && isset($_POST['discountTypeAdd']) && $_POST['discountTypeAdd'] != '' && isset($_POST['discountValueAdd']) && $_POST['discountValueAdd'] != '' && isset($_POST['discountDescAdd']) && $_POST['discountDescAdd'] != '' ) {
                            $id = json_decode($dataToken)->{'id'};
                            $admin = $this->get_model('admin')->get_by_id($id);
                            if ($admin != null) {
                                if ($admin['ad_role'] == Enum::ROLE_MANAGER) {
                                    $discountModel = $this->get_model('discount');
                                    $discount = $discountModel->get_data("where dc_code = '" . $_POST['discountCodeAdd'] . "' and dc_active = 1");
                                    if ($discount == null) {
                                        if ($_POST['discountStartTimeAdd'] < $_POST['discountEndTimeAdd']) {
                                            $date = date("Y/m/d", strtotime($_POST['discountStartTimeAdd']));
                                            $dt = new DateTime("now", new DateTimeZone('Asia/Saigon'));
                                            $dateTimeToday = $dt->setTimestamp(time())->format('Y/m/d H:i:s');
                                            $dateTimeStart = $date . " 00:00:00";
                                            if (strtotime($dateTimeStart) - strtotime($dateTimeToday) > 86400) {
                                                $value = 0;
                                                $valuePercent = 0;
                                                if ($_POST['discountTypeAdd'] == 'value') $value = $_POST['discountValueAdd'];
                                                else $valuePercent = $_POST['discountValueAdd'];
                                                $quantiy = $_POST['discountQuantityAdd'] != '' ? $_POST['discountQuantityAdd'] : 'null';
                                                $dataDiscount = [
                                                    'code' => $_POST['discountCodeAdd'],
                                                    'condition' => $_POST['discountConditionAdd'],
                                                    'quantity' => $quantiy,
                                                    'start' => $_POST['discountStartTimeAdd'],
                                                    'end' => $_POST['discountEndTimeAdd'],
                                                    'value' => $value,
                                                    'valuePercent' => $valuePercent,
                                                    'desc' => $_POST['discountDescAdd']
                                                ];
                                                // $data = [
                                                //     'start' => $dateTimeStart,
                                                //     'today' => $dateTimeToday,
                                                //     'diff' => strtotime($dateTimeStart) - strtotime($dateTimeToday)
                                                // ];
                                                if ($discountModel->save_data($dataDiscount)) {
                                                    $responseCode = ResponseCode::SUCCESS;
                                                    $message = "SERV: " . sprintf(ResponseMessage::INSERT_MESSAGE, "mã giảm giá", "thành công");
                                                } else {
                                                    $message = "SERV: " . sprintf(ResponseMessage::INSERT_MESSAGE, "mã giảm giá", "thất bại");
                                                }
                                            } else {
                                                $responseCode = ResponseCode::INPUT_INVALID_TYPE;
                                                $message = "SERV: Mã giảm giá phải tạo tối thiểu trước 24 tiếng ngày bắt đầu.";
                                            }
                                        } else {
                                            $responseCode = ResponseCode::INPUT_INVALID_TYPE;
                                            $message = "SERV: Thời gian kết thúc phải sau thời gian bắt đầu.";
                                        }
                                    } else {
                                        $responseCode = ResponseCode::OBJECT_EXISTS;
                                        $message = "SERV: " . sprintf(ResponseMessage::OBJECT_EXISTS_MESSAGE, "Mã giảm giá");
                                    }
                                } else {
                                    $responseCode = ResponseCode::ACCESS_DENIED;
                                    $message = "SERV1: " . ResponseMessage::ACCESS_DENIED_MESSAGE;
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

    public function data_detail_discount()
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
                if (isset($_GET['discountId']) && $_GET['discountId'] != '') {
                    $discountModel = $this->get_model('discount');
                    $discount = $discountModel->get_by_id($_GET['discountId']);
                    if ($discount != null) {
                        $responseCode = ResponseCode::SUCCESS;
                        $message = "SERV: " . sprintf(ResponseMessage::SELECT_MESSAGE, 'giảm giá', 'thành công');
                        $data = [
                            'discount' => $discount
                        ];
                    } else {
                        $responseCode = ResponseCode::OBJECT_DOES_NOT_EXIST;
                        $message = "SERV: " . sprintf(ResponseMessage::OBJECT_DOES_NOT_EXIST_MESSAGE, 'giảm giá');
                    }
                } else {
                    $responseCode = ResponseCode::INPUT_EMPTY;
                    $message = "SERV: " . sprintf(ResponseMessage::INPUT_EMPTY_MESSAGE, "giảm giá");
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

    public function edit_discount()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($this->check_admin() && $this->check_admin_role(Enum::ROLE_MANAGER)) {
                    $token = isset($_POST['token']) && $_POST['token'] != null ? $_POST['token'] : '';
                    $dataToken = $this->verify_and_decode_token($token);
                    if (!$dataToken) {
                        $responseCode = ResponseCode::TOKEN_INVALID;
                        $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE . " token:" . $token;
                    } else {
                        if (isset($_POST['discountIdEdit']) && $_POST['discountIdEdit'] != '' && isset($_POST['discountStatusEdit']) && $_POST['discountStatusEdit'] != '') {
                            //&& isset($_FILES["svImg"]) && !$_FILES["svImg"]["name"] != ''
                            $id = json_decode($dataToken)->{'id'};
                            $admin = $this->get_model('admin')->get_by_id($id);
                            if ($admin != null) {
                                if ($admin['ad_role'] == Enum::ROLE_MANAGER) {
                                    //$img = $_FILES["svImg"];
                                    //if ($this->save_img(ServiceController::PATH_IMG_SERVICE,$img)) {
                                    $dataDiscount = [
                                        'dc_active' => $_POST['discountStatusEdit']
                                    ];
                                    $discountModel = $this->get_model('discount');
                                    if ($discountModel->update_data($dataDiscount,$_POST['discountIdEdit'])) {
                                        $responseCode = ResponseCode::SUCCESS;
                                        $message = "SERV: " . sprintf(ResponseMessage::UPDATE_MESSAGE, "giảm giá", "thành công");
                                    } else {
                                        $message = "SERV: " . sprintf(ResponseMessage::UPDATE_MESSAGE, "giảm giá", "thất bại");
                                    }
                                    //} else {
                                    //    $message = "SERV: " . sprintf(ResponseMessage::INSERT_MESSAGE,"ảnh dịch vụ","thất bại");
                                    //}
                                } else {
                                    $responseCode = ResponseCode::ACCESS_DENIED;
                                    $message = "SERV1: " . ResponseMessage::ACCESS_DENIED_MESSAGE;
                                }
                            } else {
                                $responseCode = ResponseCode::OBJECT_DOES_NOT_EXIST;
                                $message = "SERV: " . sprintf(ResponseMessage::OBJECT_DOES_NOT_EXIST_MESSAGE, 'admin');
                            }
                        } else {
                            $responseCode = ResponseCode::INPUT_EMPTY;
                            $message = "SERV: " . sprintf(ResponseMessage::INPUT_EMPTY_MESSAGE, "giảm giá");
                        }
                    }
                } else {
                    $responseCode = ResponseCode::ACCESS_DENIED;
                    $message = "SERV: " . ResponseMessage::ACCESS_DENIED_MESSAGE ;
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
