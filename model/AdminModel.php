<?php 
//include("BaseModel.php");
class AdminModel extends BaseModel{

    private $connection;
    var $table = 'admin';
    var $idTable = 'ad_id';
    var $view = 'admin';
    var $viewJoin = 'admin';
    var $insert = ['ad_username', 'ad_password', 'ad_role'];

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

    public function get_by_username($username,$status){
        $response = null;
        $conn = $this->get_connection();
        //echo $query;
        try {
            $stm = $conn->prepare("SELECT * FROM  {$this->table} WHERE ad_username = ? and ad_status = ?");
            $stm->bind_param('si', $username,$status);
            if ($stm->execute() && !$stm->errno) {
                $result = $stm->get_result();
                if ($result->num_rows > 0) {
                    $response = $result->fetch_assoc();
                }
            } else {
                throw new mysqli_sql_exception("Statement error: " . $stm->error);
            }
        } catch (mysqli_sql_exception $e) {
            echo ("Error: " . $e->getMessage());
        }
        $stm->close();
        $conn->close();
        return $response;
    }
    public function save_data($data)
    {
        $value = "'" . $data['username'] . "','" . $data['password'] . "'," . $data['role'];
        return $this->save($value);
    }

    public function update_data($data, $id)
    {
        return $this->update($data, $id);
    }
};
