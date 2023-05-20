<?php
class PetController extends BaseController
{

    public function customer_pet()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->check_login()) {
                $this->render_view(
                    'customer-pet',
                );
            } else $this->redirect('home', 'index');
        } else include('view/error/error-400.php');
    }

    public function data_customer_pet()
    {
        $responseCode = ResponseCode::FAIL;
        $message = sprintf(ResponseMessage::UNKNOWN_ERROR_MESSAGE,"");
        $data[] = null;
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if ($this->check_login()) {
                $token = isset($_GET['token']) && $_GET['token'] != null ? $_GET['token'] : '';
                $dataToken = $this->verify_and_decode_token($token);
                if (!$dataToken) {
                    $responseCode = ResponseCode::TOKEN_INVALID;
                    $message = ResponseMessage::ACCESS_DENIED_MESSAGE;
                } else {
                    $id = json_decode($dataToken)->{'id'};
                    $role = json_decode($dataToken)->{'role'}; 
                    $petModel = $this->get_model('pet');
                    $pet = null;
                    if ($role == -1) {
                        $pet = $petModel->get_by_customer($id);
                        if ($pet != null) {
                            $responseCode = ResponseCode::SUCCESS;
                            $message = sprintf(ResponseMessage::SELECT_MESSAGE,'thú cưng','thành công');
                            $data = [
                                'pet' => $pet
                            ];
                        } else {
                            $responseCode = ResponseCode::DATA_EMPTY;
                            $message = sprintf(ResponseMessage::DATA_EMPTY_MESSAGE,'thú cưng');
                        }
                    } else {
                        $responseCode = ResponseCode::ACCESS_DENIED;
                        $message = ResponseMessage::ACCESS_DENIED_MESSAGE;
                    }
                }
            } else {
                $responseCode = ResponseCode::ACCESS_DENIED;
                $message = ResponseMessage::ACCESS_DENIED_MESSAGE;
            }
        } else {
            $responseCode = ResponseCode::REQUEST_INVALID;
            $message = sprintf(ResponseMessage::REQUEST_INVALID_MESSAGE); 
        }
        $this->response($responseCode,$message,$data);
    }
}
