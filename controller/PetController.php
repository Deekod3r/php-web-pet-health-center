<?php
class PetController extends BaseController
{

    public function customer_pet()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->checkLogin()) {
                $shopRepo = $this->getRepo('shop');
                $shop = $shopRepo->getData("");
                $petRepo = $this->getRepo('pet');
                $pet = $petRepo->getByCustomer($_SESSION['id']);
                $this->renderView(
                    'customer_pet',
                    [
                        'shop' => $shop,
                        'pet' => $pet
                    ]
                );
            }
        } else include('view/error/error-400.php');
    }
}
