<?php 
//include("BaseModel.php");
class CategoryNewsModel extends BaseModel{

    private $connection;
    var $table = 'category_news';
    var $id_table = 'cn_id';
    public function __construct(){
        //$this->connection = $this->get_connection();
    }

    public function get_data($key){
        $result = $this->find_all($key);
        return $result;
    }

};
