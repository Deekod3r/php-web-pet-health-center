<?php 
//include("BaseRepository.php");
class NewsRepository extends BaseRepository{

    private $connection;
    var $table = 'news';
    var $id_table = 'news_id';
    public function __construct(){
        //$this->connection = $this->getConnection();
    }

    public function getData($key){
        $result = $this->findAll($key);
        return $result;
    }

};
