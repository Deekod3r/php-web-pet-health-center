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
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $shopModel = $this->get_model('shop');
            $shop = $shopModel->get_data("");
            $result = [
                "statusCode" => "1",
                "message" => "OK",
                "data" => [
                    'shop' => $shop
                ]
            ];
            echo json_encode($result);
        } else $this->redirect('home', 'index');
    }
}
