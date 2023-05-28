<?php 
//include("BaseModel.php");
class NewsModel extends BaseModel{

    private $connection;
    var $table = 'news';
    var $idTable = 'news_id';
    var $view = 'view_news';
    var $viewJoin = 'view_news_join';
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

    public function get_by_id($id){
        return $this->find_by_id($id);
    }

    public function delete_data($id) {
        return $this->delete_soft($id);
    }
};
