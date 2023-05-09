<?php
class ShopController extends BaseController
{

    public function about_page()
    {
        $shopRepo = $this->getRepo('shop');
        $shop = $shopRepo->getData("");
        $this->renderView(
            'about',
            [
                'shop' => $shop
            ]
        );
    }

    public function contact_page()
    {
        $shopRepo = $this->getRepo('shop');
        $shop = $shopRepo->getData("");
        $this->renderView(
            'contact',
            [
                'shop' => $shop
            ]
        );
    }
}
