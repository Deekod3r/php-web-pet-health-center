<?php 
//include("BaseRepository.php");
class FeedbackModel extends BaseModel{

    private $connection;
    var $table = 'feedback';
    var $idTable = 'fb_id';
    var $insert = ['fb_content', 'fb_rating', 'ctm_id'];
    var $view = 'view_feedback';
    var $viewJoin = 'view_feedback_join';
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
    public function save_data($data){
        $value = "'".$data['content']."',".$data['rating'].",".$data['ctmId'];
        return $this->save($value);
    }
   
    public function native_query($query)
    {
        return $this->navtive_query($query);
    }

    public function get_by_id($id)
    {
        return $this->find_by_id($id);
    }
    public function update_data($data, $id)
    {
        return $this->update($data, $id);
    }
};
