<?php
class BillController extends BaseController
{

    public function customer_history()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->checkLogin()) {
                $shopRepo = $this->getRepo('shop');
                $shop = $shopRepo->getData("");
                $billRepo = $this->getRepo('bill');
                $bill = $billRepo->getByCustomer($_SESSION['id']);
                $this->renderView(
                    'customer_history',
                    [
                        'shop' => $shop,
                        'bill' => $bill
                    ]
                );
            }
        } else include('view/error/error-400.php');
    }
}
