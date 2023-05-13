<?php 
//include("BaseModel.php");
class CategoryNewsModel extends BaseModel{

    private $connection;
    var $table = 'category_news';
    var $id_table = 'cn_id';
    public function __construct(){
        //$this->connection = $this->getConnection();
    }

    public function getData($key){
        $result = $this->findAll($key);
        return $result;
    }

};
