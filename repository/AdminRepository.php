<?php 
include("BaseRepository.php");
class AdminRepository extends BaseRepository{

    private $connection;
    var $table = 'admin';
    var $id_table = 'ad_id';
    public function __construct(){
        //$this->connection = $this->getConnection();
    }

    public function getData(){
        $json_result = $this->findAll();
        var_dump($json_result);
    }

    protected function getByAccount($phone,$password){
        $query = "SELECT * FROM " . $this->table . " WHERE ad_phone ='" . $phone . "' and ad_password = '" . $password ."'";
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
