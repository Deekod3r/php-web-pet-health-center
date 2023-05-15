<?php 
//include("BaseModel.php");
class AppointmentModel extends BaseModel{

    private $connection;
    var $table = 'appointment';
    var $idTable = 'apm_id';
    var $insert = ['apm_date', 'apm_time', 'apm_note' , 'ctm_id', 'cs_id'];
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

    public function get_by_customer($customer,$key){
        if ($key == "") {
            $query = "SELECT * FROM " . $this->table . " where is_delete = 0 and ctm_id = $customer";
        }  else $query = "SELECT * FROM " . $this->table . " where is_delete = 0 and ctm_id = $customer " . $key;
        //echo $query;
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

    public function save_data($data){
        $value = "'".$data['date']."','".$data['time']."','".$data['note']."',".$data['ctmId'].",".$data['categoryService'];
        return $this->save($value);
    }

    public function cancel_appointmnet($idApm, $idCtm){
        $query = "update $this->table set apm_status = ".Enum::STATUS_APPOINTMENT_CANCEL." where $this->idTable = " . $idApm . " and ctm_id = " . $idCtm;
        //echo $query;
        if($this->get_connection()->query($query)){
            return true;
        } else return false;
    }
};
