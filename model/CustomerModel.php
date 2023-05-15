<?php 
//include("BaseModel.php");
class CustomerModel extends BaseModel{

    private $connection;
    var $table = 'customer';
    var $idTable = 'ctm_id';
    var $insert = ['ctm_name', 'ctm_phone', 'ctm_email', 'ctm_address', 'ctm_password', 'ctm_gender'];
    public function __construct(){
        //$this->connection = $this->get_connection();
    }

    public function get_data($key){
        $result = $this->find_all($key);
        return $result;
    }

    public function get_by_phone($phone){
        $query = "SELECT * FROM " . $this->table . " WHERE ctm_phone ='" . $phone ."'";
        //echo $query;
        $result = $this->get_connection()->query($query);
        if($result->num_rows > 0) {
            return $result->fetch_assoc();
        } 
        return null;
    }

    public function get_by_account($phone,$password){
        $query = "SELECT * FROM " . $this->table . " WHERE ctm_phone ='" . $phone . "' and ctm_password = '" . $password ."'";
        //echo $query;
        $result = $this->get_connection()->query($query);
        if($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data;
        } 
        return null;
    }

    public function get_by_id($id){
        return  $this->find_by_id($id);
    }

    public function save_data($data){
        $value = "'".$data['name']."','".$data['phone']."','".$data['email']."','".$data['address']."','".$data['password']."',".$data['gender'];
        return $this->save($value);
    }
}
