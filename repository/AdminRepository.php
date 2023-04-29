<?php 
//include("BaseRepository.php");
class AdminRepository extends BaseRepository{

    private $connection;
    var $table = 'admin';
    var $id_table = 'ad_id';
    public function __construct(){
        //$this->connection = $this->getConnection();
    }

    public function getData(){
        return $this->findAll();
    }

    public function getByAccount($phone,$password){
        $query = "SELECT * FROM " . $this->table . " WHERE ad_phone ='" . $phone . "' and ad_password = '" . $password ."'";
        $result = null;
        try{
            $result = $this->getConnection()->query($query);
            if($result->num_rows > 0) {
                $data = $result->fetch_assoc();
                return $data;
            } else return null;
        } catch(Exception $e){
        }
        return null;
    }
};
