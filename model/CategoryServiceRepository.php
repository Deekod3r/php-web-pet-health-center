<?php 
//include("BaseRepository.php");
class CategoryServiceRepository extends BaseRepository{

    private $connection;
    var $table = 'category_service';
    var $id_table = 'cs_id';
    public function __construct(){
        //$this->connection = $this->getConnection();
    }

    public function getData($key){
        $result = $this->findAll($key);
        return $result;
    }

};
