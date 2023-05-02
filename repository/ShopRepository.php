<?php 
//include("BaseRepository.php");
class ShopRepository extends BaseRepository{

    private $connection;
    var $table = 'shop_info';
    var $id_table = 'shop_name';
    public function __construct(){
        //$this->connection = $this->getConnection();
    }

    public function getData($key){
        $result = $this->findAll($key);
        return $result[0];
    }

    
};
