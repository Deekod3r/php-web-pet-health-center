<?php 
//include("BaseModel.php");
class ServiceModel extends BaseModel{

    private $connection;
    var $table = 'service';
    var $idTable = 'sv_id';
    var $view = 'view_service';
    var $viewJoin = 'view_service_join';
    var $insert = ['sv_name','sv_description', 'sv_price','sv_img','sv_pet','sv_status','cs_id'];

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
    
    public function save_data($data){
        $value = "'".$data['name']."','".$data['description']."',".$data['price'].",'".$data['img']."',".$data['pet'].",".$data['status'].",".$data['cs'];
        return $this->save($value);
    }

    public function update_data($data, $id)
    {
        return $this->update($data, $id);
    }

    public function delete_data($id) {
        return $this->delete_soft($id);
    }
};
