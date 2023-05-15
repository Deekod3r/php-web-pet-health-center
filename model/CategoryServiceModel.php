<?php 
//include("BaseModel.php");
class CategoryServiceModel extends BaseModel{

    private $connection;
    var $table = 'category_service';
    var $idTable = 'cs_id';
    public function __construct(){
        //$this->connection = $this->get_connection();
    }

    public function get_data($key){
        $result = $this->find_all($key);
        return $result;
    }

};
