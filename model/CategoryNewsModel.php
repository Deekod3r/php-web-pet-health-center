<?php 
//include("BaseModel.php");
class CategoryNewsModel extends BaseModel{

    private $connection;
    var $table = 'category_news';
    var $idTable = 'cn_id';
    var $view = 'view_category_news';
    var $viewJoin = 'view_category_news';
    var $insert = ['cn_name'];

    public function __construct(){
        //$this->connection = $this->get_connection();
    }

    public function get_data($key){
        $result = $this->find_all($key);
        return $result;
    }
    public function save_data($data){
        $value = "'".$data['cnName']."'";
        return $this->save($value);
    }
    public function update_data($data, $id)
    {
        return $this->update($data, $id);
    }

};
