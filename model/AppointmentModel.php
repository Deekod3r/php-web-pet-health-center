<?php 
//include("BaseModel.php");
class AppointmentModel extends BaseModel{

    private $connection;
    var $table = 'appointment';
    var $id_table = 'apm_id';
    var $insert = ['apm_date', 'apm_time', 'apm_note' , 'ctm_id', 'cs_id'];
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
        //echo $query;
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

    public function saveData($data){
        $value = "'".$data['date']."','".$data['time']."','".$data['note']."',".$data['ctmId'].",".$data['categoryService'];
        return $this->save($value);
    }

    public function cancelApm($idApm, $idCtm){
        $query = "update $this->table set apm_status = ".Enum::STATUS_APPOINTMENT_CANCEL." where $this->id_table = " . $idApm . " and ctm_id = " . $idCtm;
        //echo $query;
        if($this->getConnection()->query($query)){
            return true;
        } else return false;
    }
};
