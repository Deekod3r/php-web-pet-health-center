<?php
class CategoryServiceController extends BaseController
{

    public function category_service_page()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->render_view(
                ''
            );
        }
    }

    public function data_category_service()
    {
        $responseCode = ResponseCode::FAIL;
        $message = sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE, "");
        $data[] = null;
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $categoryServiceModel = $this->get_model('categoryService');
            $categoryService = $categoryServiceModel->get_data("");
            if ($categoryService != null) {
                $responseCode = "01";
                $message = sprintf(ResponseMessage::SELECT_MESSAGE,"danh mục dịch vụ","thành công.");
                $data = [
                    'categoryService' => $categoryService                
                ];
            } else {
                $responseCode = "04";
                $message = sprintf(ResponseMessage::DATA_EMPTY_MESSAGE,"danh mục dịch vụ");
            }
        } else {
            $responseCode = "98";
            $message = sprintf(ResponseMessage::REQUEST_INVALID_MESSAGE);
        }
        $this->response($responseCode, $message, $data);
    }
}
