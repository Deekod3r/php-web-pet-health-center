<?php
class ShopController extends BaseController
{

    public function about_page()
    {
        $this->render_view(
            'about'
        );
    }

    public function contact_page()
    {
        $this->render_view(
            'contact'
        );
    }

    public function data_shop()
    {
        $responseCode = ResponseCode::FAIL;
        $message = sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE,"");
        $data[] = null; 
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $shopModel = $this->get_model('shop');
            $shop = $shopModel->get_data("");
            if ($shop != null) {
                $responseCode = "01";
                $message = sprintf(ResponseMessage::SELECT_MESSAGE,"cửa hàng","thành công.");
                $data = [
                    'shop' => $shop
                ];
            } else {
                $responseCode = "04";
                $message = sprintf(ResponseMessage::DATA_EMPTY_MESSAGE,"cửa hàng");
            }
        } else {
            $responseCode = "98";
            $message = sprintf(ResponseMessage::REQUEST_INVALID);
        }
        $this->response($responseCode,$message,$data);
    }
}
