<?php
class CategoryServiceController extends BaseController
{

    public function category_service_page()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->render_view(
                ''
            );
        } else $this->render_error('400');
    }

    public function data_category_service()
    {
        $responseCode = ResponseCode::FAIL;
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        try {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $categoryServiceModel = $this->get_model('categoryService');
                $categoryService = $categoryServiceModel->get_data("");
                if ($categoryService != null) {
                    $responseCode = "01";
                    $message = "SERV: " . sprintf(ResponseMessage::SELECT_MESSAGE,"danh mục dịch vụ","thành công.");
                    $data = [
                        'categoryService' => $categoryService                
                    ];
                } else {
                    $responseCode = "04";
                    $message = "SERV: " . sprintf(ResponseMessage::DATA_EMPTY_MESSAGE,"danh mục dịch vụ");
                }
            } else {
                $responseCode = "98";
                $message = "SERV: " . sprintf(ResponseMessage::REQUEST_INVALID_MESSAGE);
            }
        } catch (Exception $e) {
            $responseCode = ResponseCode::UNKNOWN_ERROR;
            $message = "SERV: " . $e->getMessage();
        }
        $this->response($responseCode, $message, $data);
    }
}
