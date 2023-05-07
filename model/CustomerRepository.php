<?php 
//include("BaseRepository.php");
class CustomerRepository extends BaseRepository{

    private $connection;
    var $table = 'customer';
    var $id_table = 'ctm_id';
    var $insert = ['ctm_name', 'ctm_phone', 'ctm_email', 'ctm_address', 'ctm_password', 'ctm_gender'];
    public function __construct(){
        //$this->connection = $this->getConnection();
    }

    public function getData($key){
        $result = $this->findAll($key);
        return $result;
    }

    public function getByAccount($phone,$password){
        $query = "SELECT * FROM " . $this->table . " WHERE ctm_phone ='" . $phone . "' and ctm_password = '" . $password ."'";
        //echo $query;
        $result = $this->getConnection()->query($query);
        if($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data;
        } 
        return null;
    }

    public function getById($id){
        return  $this->findById($id);
    }

    public function saveData($data){
        $value = "'".$data['name']."','".$data['phone']."','".$data['email']."','".$data['address']."','".$data['password']."',".$data['gender'];
        return $this->save($value);
    }
}
