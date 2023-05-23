<?php 
//include("BaseModel.php");
class DiscountModel extends BaseModel{

    private $connection;
    var $table = 'discount';
    var $idTable = 'dc_id';
    var $view = 'discount';
    var $viewJoin = 'discount';

    public function __construct(){
        //$this->connection = $this->get_connection();
    }

    public function get_data($key){
        return $this->find_all($key);
    }
    
    public function get_by_id($id)
    {
        return $this->find_by_id($id);
    }
    
    
    public function count_data($key){
        return $this->get_data($key) != null ? count($this->get_data($key)) : 0;
    }


    
};
