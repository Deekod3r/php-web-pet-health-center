<?php 
//include("BaseRepository.php");
class FeedbackModel extends BaseModel{

    private $connection;
    var $table = 'feedback';
    var $id_table = 'fb_id';
    var $insert = ['fb_content', 'fb_rating', 'fb_time' , 'ctm_id'];
    public function __construct(){
        //$this->connection = $this->getConnection();
    }

    public function getData($key){
        $result = $this->findAll($key);
        return $result;
    }

    public function saveData($data){
        $value = "'".$data['content']."',".$data['rating'].",'".$data['time']."',".$data['ctmId'];
        return $this->save($value);
    }
   
};
