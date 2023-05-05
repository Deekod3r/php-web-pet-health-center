<?php 
//include("BaseRepository.php");
class AdminRepository extends BaseRepository{

    private $connection;
    var $table = 'admin';
    var $id_table = 'ad_id';
    public function __construct(){
        //$this->connection = $this->getConnection();
    }

    public function getData($key){
        return $this->findAll($key);
    }

    public function getByAccount($username,$password){
        $query = "SELECT * FROM " . $this->table . " WHERE ad_username ='" . $username . "' and ad_password = '" . $password ."'";
        $result = $this->getConnection()->query($query);
        if($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data;
        }
        return null;
    }
};
