<?php 
//include("BaseRepository.php");
class ServiceRepository extends BaseRepository{

    private $connection;
    var $table = 'service';
    var $id_table = 'sv_id';
    public function __construct(){
        //$this->connection = $this->getConnection();
    }

    public function getData($key){
        $result = $this->findAll($key);
        return $result;
    }

};
