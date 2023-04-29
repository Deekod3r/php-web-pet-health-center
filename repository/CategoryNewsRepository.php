<?php 
//include("BaseRepository.php");
class CategoryNewsRepository extends BaseRepository{

    private $connection;
    var $table = 'category_news';
    var $id_table = 'cn_id';
    public function __construct(){
        //$this->connection = $this->getConnection();
    }

    public function getData(){
        $result = $this->findAll();
        return $result;
    }

};
