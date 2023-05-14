<?php 
//include("BaseModel.php");
class NewsModel extends BaseModel{

    private $connection;
    var $table = 'news';
    var $id_table = 'news_id';
    public function __construct(){
        //$this->connection = $this->get_connection();
    }

    public function get_data($key){
        $result = $this->find_all($key);
        return $result;
    }
    
    public function count_data($key){
        return count($this->get_data($key));
    }

    public function get_by_id($id){
        return $this->find_by_id($id);
    }
};
