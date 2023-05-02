<?php 
//include("BaseRepository.php");
class FeedbackRepository extends BaseRepository{

    private $connection;
    var $table = 'feedback';
    var $id_table = 'fb_id';
    public function __construct(){
        //$this->connection = $this->getConnection();
    }

    public function getData($key){
        $result = $this->findAll($key);
        return $result;
    }

   
};
