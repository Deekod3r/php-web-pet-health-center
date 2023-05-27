<?php 
//include("BaseModel.php");
class ShopModel extends BaseModel{

    private $connection;
    var $table = 'shop_info';
    var $view = 'shop_info';
    var $viewJoin = 'shop_info';
    var $idTable = 'shop_id';
    public function __construct(){
        //$this->connection = $this->get_connection();
    }

    public function get_data($key){
        $result = $this->find_all($key);
        return $result[0];
    }
    public function update_data($data, $id)
    {
        return $this->update($data, $id);
    }
};
