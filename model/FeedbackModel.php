<?php 
//include("BaseRepository.php");
class FeedbackModel extends BaseModel{

    private $connection;
    var $table = 'feedback';
    var $idTable = 'fb_id';
    var $insert = ['fb_content', 'fb_rating', 'fb_time' , 'ctm_id'];
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
        $value = "'".$data['content']."',".$data['rating'].",'".$data['time']."',".$data['ctmId'];
        return $this->save($value);
    }
   
};
