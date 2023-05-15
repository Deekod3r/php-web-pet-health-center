<?php 
//include("BaseModel.php");
class BillModel extends BaseModel{

    private $connection;
    var $table = 'bill';
    var $idTable = 'bill_id';
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

    public function count_data($key){
        return count($this->get_data($key));
    }

    public function count_data_by_customer($customer){
        return count($this->get_by_customer($customer));
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
