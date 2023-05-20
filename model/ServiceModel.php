<?php 
//include("BaseModel.php");
class ServiceModel extends BaseModel{

    private $connection;
    var $table = 'service';
    var $idTable = 'sv_id';
    var $view = 'view_service';
    var $viewJoin = 'view_service_join';
    public function __construct(){
        //$this->connection = $this->get_connection();
    }

    public function get_data($key){
        $result = $this->find_all($key);
        return $result;
    }

    public function count_data($key){
        return $this->get_data($key) != null ? count($this->get_data($key)) : 0;
    }

};
