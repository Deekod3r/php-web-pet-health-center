<?php
//include("BaseModel.php");
class BillModel extends BaseModel
{

    private $connection;
    var $table = 'bill';
    var $idTable = 'bill_id';
    var $view = 'view_bill';
    var $viewJoin = 'view_bill_join';
    var $insert = ['ctm_id','ad_id'];

    public function __construct()
    {
        //$this->connection = $this->get_connection();
    }

    public function get_data($key)
    {
        $result = $this->find_all($key);
        return $result;
    }

    public function get_by_id($id)
    {
        return $this->find_by_id($id);
    }

    public function count_data($key){
        return $this->get_data($key) != null ? count($this->get_data($key)) : 0;
    }

    public function count_data_by_customer($customer)
    {
        return $this->get_by_customer($customer) != null ? count($this->get_by_customer($customer)) : 0;
    }

    public function get_by_customer($customer)
    {
        $response = null;
        $conn = $this->get_connection();
        try {
            $stm = $conn->prepare("SELECT * FROM {$this->viewJoin} where ctm_id = ?");
            $stm->bind_param('i', $customer);
            if ($stm->execute() && !$stm->errno) {
                $result = $stm->get_result();
                $data = [];
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $data[] = $row;
                    }
                    $response = $data;
                    $stm->close();
                    $conn->close();
                    return $response;
                }
            } else {
                throw new mysqli_sql_exception("Statement error: " . $stm->error);
            }
        } catch (mysqli_sql_exception $e) {
            $stm->close();
            $conn->close();
            echo ("Error: " . $e->getMessage());
            return false;
        }
    }

    public function check_bill($idBill,$idCustomer){
        $conn = $this->get_connection();
        try {
            $stm = $conn->prepare("SELECT count(*) FROM {$this->viewJoin} where ctm_id = ? and bill_id = ?");
            $stm->bind_param('ii', $idCustomer,$idBill);
            if ($stm->execute() && !$stm->errno) {
                $result = $stm->get_result();
                if ($result->num_rows > 0) {
                    $stm->close();
                    $conn->close();
                    return true;
                }
            } else {
                throw new mysqli_sql_exception("Statement error: " . $stm->error);
            }
        } catch (mysqli_sql_exception $e) {
            $stm->close();
            $conn->close();
            echo ("Error: " . $e->getMessage());
            return false;
        }
    }

    public function save_data($data){
        $value = "'".$data['ctm']."',".$data['ad'];
        return $this->save($value);
    }
    public function update_data($data, $id)
    {
        return $this->update($data, $id);
    }

    public function native_query($query)
    {
        return $this->navtive_query($query);
    }
};
