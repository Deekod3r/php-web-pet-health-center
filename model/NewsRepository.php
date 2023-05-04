<?php 
//include("BaseRepository.php");
class NewsRepository extends BaseRepository{

    private $connection;
    var $table = 'news';
    var $id_table = 'news_id';
    public function __construct(){
        //$this->connection = $this->getConnection();
    }

    public function getData($key,$limit){
        $order = " order by news_date_release DESC";
        if ($limit > 0) {
            $order .= " limit " . $limit;
        }
        $result = $this->findAll($key . $order);
        return $result;
    }

    public function getById($id){
        return $this->findById($id);
    }
};
