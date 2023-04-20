<?php 
class AdminRepository extends BaseRepository{

    private $connection;
    var $table = 'admin';
    var $id_table = 'ad_id';
    public function __construct(){
        //$this->connection = $this->getConnection();
    }

    public function getData(){
        $json_result = $this->findAll();
        var_dump($json_result);
    }
};
