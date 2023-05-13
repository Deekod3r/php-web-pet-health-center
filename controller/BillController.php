<?php
class BillController extends BaseController
{

    public function customer_history()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->checkLogin()) {
                $this->renderView(
                    'customer_history',
                );
            } else $this->redirect('home', 'index');
        } else include('view/error/error-400.php');
    }

    public function data_customer_history()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->checkLogin()) {
                $token = $_GET['token'];
                $data = $this->verify_and_decode_token($token);
                if (!$data) {
                    $this->redirect('home', 'index');
                } else {
                    $id = json_decode($data)->{'id'};                  
                    $billRepo = $this->getRepo('bill');
                    $bill = $billRepo->getByCustomer($id);
                    $result = [
                        "statusCode" => "1",
                        "message" => "OK",
                        "data" => [
                            'bill' => $bill
                        ]
                    ];
                    echo json_encode($result);
                }
            } else $this->redirect('home', 'index');
        } else include('view/error/error-400.php');
    }
}
