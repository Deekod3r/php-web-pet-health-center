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
        $message = "SERV: " . sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE,"");
        $data[] = null; 
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $shopModel = $this->get_model('shop');
            $shop = $shopModel->get_data("");
            if ($shop != null) {
                $responseCode = ResponseCode::SUCCESS;
                $message = "SERV: " . sprintf(ResponseMessage::SELECT_MESSAGE,"cửa hàng","thành công.");
                $data = [
                    'shop' => $shop
                ];
            } else {
                $responseCode = ResponseCode::DATA_EMPTY;
                $message = "SERV: " . sprintf(ResponseMessage::DATA_EMPTY_MESSAGE,"cửa hàng");
            }
        } else {
            $responseCode = ResponseCode::REQUEST_INVALID;
            $message = "SERV: " . sprintf(ResponseMessage::REQUEST_INVALID_MESSAGE);
        }
        $this->response($responseCode,$message,$data);
    }
}
