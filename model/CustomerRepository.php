<?php 
//include("BaseRepository.php");
class CustomerRepository extends BaseRepository{

    private $connection;
    var $table = 'customer';
    var $id_table = 'ctm_id';
    public function __construct(){
        //$this->connection = $this->getConnection();
    }

    public function getData($key){
        $result = $this->findAll($key);
        return $result;
    }

    public function getByAccount($phone,$password){
        $query = "SELECT * FROM " . $this->table . " WHERE ctm_phone ='" . $phone . "' and ctm_password = '" . $password ."'";
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

    public function getById($id){
        return  $this->findById($id)[0];
    }
};
