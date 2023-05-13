<?php 
//include("BaseModel.php");
class AdminModel extends BaseModel{

    private $connection;
    var $table = 'admin';
    var $id_table = 'ad_id';
    public function __construct(){
        //$this->connection = $this->getConnection();
    }

    public function getData($key){
        return $this->findAll($key);
    }
    public function getByUsername($username){
        $query = "SELECT * FROM " . $this->table . " WHERE ad_username ='" . $username ."'";
        //echo $query;
        $result = $this->getConnection()->query($query);
        if($result->num_rows > 0) {
            return $result->fetch_assoc();
        } 
        return null;
    }
    public function getByAccount($username,$password){
        $query = "SELECT * FROM " . $this->table . " WHERE ad_username = '" . $username . "' and ad_password = '" . $password ."'";
        //echo $query;
        $result = $this->getConnection()->query($query);
        if($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data;
        }
        return null;
    }
};
