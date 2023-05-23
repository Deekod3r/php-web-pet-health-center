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
                if (isset($_GET['svName']) and $_GET['svName'] != '') {
                    $key .= "concat(sv_name,sv_description) like '%" . $_GET['svName'] . "%'";
                }
                if (isset($_GET['typePet']) and $_GET['typePet'] != '') {
                    if ($key != '') {
                        $key .= ' and ';
                    }
                    $key .= " sv_pet in (" . $_GET['typePet'] . "," . Enum::TYPE_BOTH . ")";
                }
                if (isset($_GET['categoryService']) and $_GET['categoryService'] != '') {
                    if ($key != '') {
                        $key .= ' and ';
                    }
                    $key .= " cs_id = " . $_GET['categoryService'];
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
                    $key .= " order by dc_end_time desc, dc_start_time desc ";
                    if (isset($_GET['limit']) and $_GET['limit'] != '') {
                        $limit = $_GET['limit'];
                        if ($limit > 0) {
                            $key .= " limit " . $limit;
                            if (isset($_GET['index']) and $_GET['index'] != '') {
                                $index = $_GET['index'];
                                if ($index > 1) {
                                    $offset = ($index-1) * $limit; 
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
                            'count' => $count
                        ];
                    } else {
                        $responseCode = ResponseCode::OBJECT_DOES_NOT_EXIST;
                        $message = "SERV: " . sprintf(ResponseMessage::OBJECT_DOES_NOT_EXIST_MESSAGE, 'mã giảm giá');
                    }
                } else {
                    $responseCode = ResponseCode::DATA_EMPTY;
                    $message = "SERV: " . sprintf(ResponseMessage::DATA_EMPTY_MESSAGE,"dịch vụ");
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
