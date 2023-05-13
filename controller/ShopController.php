<?php
class ShopController extends BaseController
{

    public function about_page()
    {
        $shopRepo = $this->getRepo('shop');
        $shop = $shopRepo->getData("");
        $this->renderView(
            'about'
        );
    }

    public function contact_page()
    {
        $shopRepo = $this->getRepo('shop');
        $shop = $shopRepo->getData("");
        $this->renderView(
            'contact'
        );
    }

    public function data_shop()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $shopRepo = $this->getRepo('shop');
            $shop = $shopRepo->getData("");
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
