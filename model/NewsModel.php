<?php 
//include("BaseModel.php");
class NewsModel extends BaseModel{

    private $connection;
    var $table = 'news';
    var $idTable = 'news_id';
    var $view = 'view_news';
    var $viewJoin = 'view_news_join';
    var $insert = ['news_title','news_description', 'news_content','news_img','news_active','cn_id','ad_id'];

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
    public function save_data($data){
        $value = "'".$data['title']."','".$data['description']."','".$data['content']."','".$data['img']."',".$data['status'].",".$data['cn'].",".$data['ad'];
        return $this->save($value);
    }

    public function update_data($data, $id)
    {
        return $this->update($data, $id);
    }
};
