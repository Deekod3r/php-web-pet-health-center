<?php 
//include("BaseModel.php");
class CategoryServiceModel extends BaseModel{

    private $connection;
    var $table = 'category_service';
    var $idTable = 'cs_id';
    var $view = 'view_category_service';
    var $viewJoin = 'view_category_service';
    var $insert = ['cs_name'];

    public function __construct(){
        //$this->connection = $this->get_connection();
    }

    public function get_data($key){
        $result = $this->find_all($key);
        return $result;
    }

    public function save_data($data){
        $value = "'".$data['csName']."'";
        return $this->save($value);
    }
    public function update_data($data, $id)
    {
        return $this->update($data, $id);
    }
};
