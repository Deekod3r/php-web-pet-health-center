<?php
class PetController extends BaseController
{

    public function customer_pet()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->check_login()) {
                $this->render_view(
                    'customer_pet',
                );
            } else $this->redirect('home', 'index');
        } else include('view/error/error-400.php');
    }

    public function data_customer_pet()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->check_login()) {
                $token = $_GET['token'];
                $data = $this->verify_and_decode_token($token);
                if (!$data) {
                    $this->redirect('home', 'index');
                } else {
                    $id = json_decode($data)->{'id'};
                    $petRepo = $this->get_model('pet');
                    $pet = $petRepo->get_by_customer($id);
                    $result = [
                        "statusCode" => "1",
                        "message" => "OK",
                        "data" => [
                            'pet' => $pet
                        ]
                    ];
                    echo json_encode($result);
                }
            } else $this->redirect( 'home','index' );
        } else include('view/error/error-400.php');
    }
}
