<?php 
class AdminRepository extends BaseRepository{

    private $connection;
    var $table = 'admin';
    public function __construct(){
        //$this->connection = $this->getConnection();
    }

    public function getData(){
        $json_result = $this->findAll();
        var_dump($json_result);
    }
};

$a = new AdminRepository();
$a->getData();