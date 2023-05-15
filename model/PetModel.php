<?php 
//include("BaseModel.php");
class PetModel extends BaseModel{

    private $connection;
    var $table = 'pet';
    var $idTable = 'pet_id';
    public function __construct(){
        //$this->connection = $this->get_connection();
    }

    public function get_data($key){
        $result = $this->find_all($key);
        return $result;
    }

    public function get_by_id($id){
        return $this->find_by_id($id);
    }

    public function get_by_customer($customer){
        $query = "SELECT * FROM " . $this->table . " where is_delete = 0 and ctm_id = $customer";
        $response = null;
        $result = $this->get_connection()->query($query);
        $data = [];
        if($result->num_rows >= 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $response = $data;
        }
        return $response;
    }
};
