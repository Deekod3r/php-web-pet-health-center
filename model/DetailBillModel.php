<?php
//include("BaseModel.php");
class DetailBillModel extends BaseModel
{

    private $connection;
    var $table = 'detail_bill';
    var $idTable = 'detail_id';
    var $view = 'view_detail_bill';
    var $viewJoin = 'view_detail_bill_join';
    var $insert = ['bill_id','sv_id','quantity','sv_price'];
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

    public function count_data($key)
    {
        return count($this->get_data($key));
    }

    public function count_data_by_customer($customer)
    {
        return $this->get_by_customer($customer) != null ? count($this->get_by_customer($customer)) : 0;
    }

    public function count_data_by_bill($customer)
    {
        return $this->get_by_bill($customer) != null ? count($this->get_by_bill($customer)) : 0;
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

    public function get_detail($idBill,$idService){
        $response = null;
        $conn = $this->get_connection();
        try {
            $stm = $conn->prepare("SELECT detail_id, bill_id, sv_id, sv_name, quantity , sv_price FROM  {$this->viewJoin} where bill_id = ? and sv_id = ?");
            $stm->bind_param('ii', $idBill,$idService);
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
            echo ("Error: " . $e->getMessage());
        }
        $stm->close();
        $conn->close();
        return $response;
    }

    public function get_by_bill($idBill)
    {
        $response = null;
        $conn = $this->get_connection();
        try {
            $stm = $conn->prepare("SELECT bill_id, sv_id, sv_name, sum(quantity) as quantity, sv_price, sum(value) as value FROM  {$this->viewJoin} where bill_id = ? group by bill_id, sv_id, sv_price");
            $stm->bind_param('i', $idBill);
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
            echo ("Error: " . $e->getMessage());
        }
        $stm->close();
        $conn->close();
        return $response;
    }

    public function delete_by_bill($idBill){
        $conn = $this->get_connection();
        try {
            $stm = $conn->prepare("DELETE FROM  {$this->table} where bill_id = ?");
            $stm->bind_param('i', $idBill);
            if ($stm->execute() && !$stm->errno) {
                $stm->close();
                $conn->close();
                return true;
            } else {
                throw new mysqli_sql_exception("Statement error: " . $stm->error);
            }
        } catch (mysqli_sql_exception $e) {
            echo ("Error: " . $e->getMessage());
        }
        $stm->close();
        $conn->close();
        return false;
    }

    public function save_data($data){
        $value = $data['bill_id'].",".$data['sv_id'].",".$data['quantity'].",".$data['sv_price'];
        return $this->save($value);
    }

    public function update_data($data, $id)
    {
        return $this->update($data, $id);
    }
};
