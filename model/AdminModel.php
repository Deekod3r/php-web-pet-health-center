<?php 
//include("BaseModel.php");
class AdminModel extends BaseModel{

    private $connection;
    var $table = 'admin';
    var $idTable = 'ad_id';
    public function __construct(){
        //$this->connection = $this->get_connection();
    }

    public function get_data($key){
        return $this->find_all($key);
    }
    
    public function get_by_username($username){
        $query = "SELECT * FROM " . $this->table . " WHERE ad_username ='" . $username ."'";
        //echo $query;
        $result = $this->get_connection()->query($query);
        if($result->num_rows > 0) {
            return $result->fetch_assoc();
        } 
        return null;
    }

    public function get_by_account($username,$password){
        $query = "SELECT * FROM " . $this->table . " WHERE ad_username = '" . $username . "' and ad_password = '" . $password ."'";
        //echo $query;
        $result = $this->get_connection()->query($query);
        if($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data;
        }
        return null;
    }
};
