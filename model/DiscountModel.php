<?php 
//include("BaseModel.php");
class DiscountModel extends BaseModel{

    private $connection;
    var $table = 'discount';
    var $idTable = 'dc_id';
    var $view = 'discount';
    var $viewJoin = 'discount';
    var $insert = ['dc_code','dc_condition', 'dc_quantity','dc_start_time','dc_end_time','dc_value','dc_value_percent','dc_description'];

    public function __construct(){
        //$this->connection = $this->get_connection();
    }

    public function get_data($key){
        return $this->find_all($key);
    }
    
    public function get_by_id($id)
    {
        return $this->find_by_id($id);
    }
    
    
    public function count_data($key){
        return $this->get_data($key) != null ? count($this->get_data($key)) : 0;
    }
    public function save_data($data){
        $value = "'".$data['code']."',".$data['condition'].",".$data['quantity'].",'".$data['start']."','".$data['end']."',".$data['value'].",".$data['valuePercent'].",'".$data['desc']."'";
        return $this->save($value);
    }

    public function update_data($data, $id)
    {
        return $this->update($data, $id);
    }
};
