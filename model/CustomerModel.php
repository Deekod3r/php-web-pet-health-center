<?php
//include("BaseModel.php");
class CustomerModel extends BaseModel
{

    private $connection;
    var $table = 'customer';
    var $idTable = 'ctm_id';
    var $insert = ['ctm_name', 'ctm_phone', 'ctm_address', 'ctm_password', 'ctm_gender', 'ctm_active'];
    var $view = 'view_customer';
    var $viewJoin = 'view_customer';

    //, 'ctm_email'
    public function __construct()
    {
        //$this->connection = $this->get_connection();
    }

    public function get_data($key)
    {
        $result = $this->find_all($key);
        return $result;
    }

    public function get_by_phone($phone, $active)
    {
        $response = null;
        $conn = $this->get_connection();
        //echo $query;
        try {
            $stm = $conn->prepare("SELECT * FROM  {$this->table} WHERE ctm_phone = ? and ctm_active = ?");
            $stm->bind_param('si', $phone, $active);
            if ($stm->execute() && !$stm->errno) {
                $result = $stm->get_result();
                if ($result->num_rows > 0) {
                    $response = $result->fetch_assoc();
                    $stm->close();
                    $conn->close();
                    return $response;
                }
            } else {
                throw new mysqli_sql_exception("Statement error: " . $stm->error);
            }
        } catch (mysqli_sql_exception $e) {
            echo ("Error: " . $e->getMessage());
            $stm->close();
            $conn->close();
            return $response;
        }
    }

    public function get_by_id($id)
    {
        return $this->find_by_id($id);
    }

    public function save_data($data)
    {
        $value = "'" . $data['name'] . "','" . $data['phone'] . "','" . $data['address'] . "','" . $data['password'] . "'," . $data['gender'] . "," . $data['active'];
        return $this->save($value);
    }

    public function update_data($data, $id)
    {
        return $this->update($data, $id);
    }
}
