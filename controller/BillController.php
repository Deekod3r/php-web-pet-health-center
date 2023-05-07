<?php 
class BillController extends BaseController{

    public function customer_history(){
        $shopRepo = $this->getRepo('shop');
        $shop = $shopRepo->getData("");
        $billRepo = $this->getRepo('bill');
        $bill = $billRepo->getByCustomer($_SESSION['id']);
        $this->renderView(
            'customer_history',[
                'shop' => $shop,
                'bill' => $bill
            ]
        );
    }

}