<?php
class ShopController extends BaseController
{

    public function about_page()
    {
        $shopRepo = $this->get_model('shop');
        $shop = $shopRepo->get_data("");
        $this->render_view(
            'about'
        );
    }

    public function contact_page()
    {
        $shopRepo = $this->get_model('shop');
        $shop = $shopRepo->get_data("");
        $this->render_view(
            'contact'
        );
    }

    public function data_shop()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $shopRepo = $this->get_model('shop');
            $shop = $shopRepo->get_data("");
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
