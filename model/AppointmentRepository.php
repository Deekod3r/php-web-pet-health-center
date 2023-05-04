<?php 
//include("BaseRepository.php");
class AppointmentRepository extends BaseRepository{

    private $connection;
    var $table = 'appointment';
    var $id_table = 'apm_id';
    public function __construct(){
        //$this->connection = $this->getConnection();
    }

    public function getData($key){
        $result = $this->findAll($key);
        return $result;
    }

    public function getById($id){
        return $this->findById($id);
    }

    public function getByCustomer($customer,$key){
        if ($key == "") {
            $query = "SELECT * FROM " . $this->table . " where is_delete = 0 and ctm_id = $customer";
        }  else $query = "SELECT * FROM " . $this->table . " where is_delete = 0 and ctm_id = $customer " . $key;
        $response = null;
        $result = $this->getConnection()->query($query);
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
