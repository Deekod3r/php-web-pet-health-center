<?php 
//include("BaseModel.php");
class ShopModel extends BaseModel{

    private $connection;
    var $table = 'shop_info';
    var $id_table = 'shop_name';
    public function __construct(){
        //$this->connection = $this->get_connection();
    }

    public function get_data($key){
        $result = $this->find_all($key);
        return $result[0];
    }

    
};
