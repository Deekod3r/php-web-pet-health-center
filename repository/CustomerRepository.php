<?php 
include("BaseRepository.php");
class AdminRepository extends BaseRepository{

    private $connection;
    var $table = 'customer';
    var $id_table = 'ctm_id';
    public function __construct(){
        //$this->connection = $this->getConnection();
    }

    public function getData(){
        $result = $this->findAll();
        return $result;
    }

    protected function getByAccount($phone,$password){
        $query = "SELECT * FROM " . $this->table . " WHERE ctm_phone ='" . $phone . "' and ctm_password = '" . $password ."'";
        $result = null;
        $response = null;
        try{
            $result = $this->getConnection()->query($query);
            $data = [];
            if($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                $response = new Response(uniqid(ResponseEnum::RESPONSE_SEARCH), ResponseEnum::SEARCH_MESSAGE_SUCCESS, $data, 200);
            } else throw new Exception();
        } catch(Exception $e){
            $response = new Response(uniqid(ResponseEnum::RESPONSE_SEARCH),ResponseEnum::SEARCH_MESSAGE_FAIL,$result,501);
        }
        return $response;
    }
};
