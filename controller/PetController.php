<?php 
class PetController extends BaseController{

    public function customer_pet(){
        $shopRepo = $this->getRepo('shop');
        $shop = $shopRepo->getData("");
        $petRepo = $this->getRepo('pet');
        $pet = $petRepo->getByCustomer($_SESSION['id']);
        $this->renderView(
            'customer_pet',[
                'shop' => $shop,
                'pet' => $pet
            ]
        );
    }

}