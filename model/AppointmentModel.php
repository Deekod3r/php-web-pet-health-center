<?php
//include("BaseModel.php");
class AppointmentModel extends BaseModel
{

    private $connection;
    var $table = 'appointment';
    var $idTable = 'apm_id';
    var $view = 'view_appointment';
    var $viewJoin = 'view_appointment_join';
    var $insert = ['apm_date', 'apm_time', 'apm_note', 'ctm_id', 'cs_id'];
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

    public function get_by_customer($customer, $key)
    {
        $response = null;
        $conn = $this->get_connection();
        //echo $query;
        try {
            $stm = $conn->prepare("SELECT * FROM  {$this->viewJoin} where ctm_id = {$customer} {$key}");
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

    public function save_data($data)
    {
        $value = "'" . $data['date'] . "','" . $data['time'] . "','" . $data['note'] . "'," . $data['ctmId'] . "," . $data['categoryService'];
        return $this->save($value);
    }

    public function cancel_appointment($idApm, $idCtm)
    {
        $conn = $this->get_connection();
        try {
            $dt = new DateTime("now", new DateTimeZone('Asia/Saigon'));
            $cancelAt = $dt->setTimestamp(time())->format('Y/m/d H:i:s');
            $stm = $conn->prepare("update $this->table set apm_status = " . Enum::STATUS_APPOINTMENT_CANCEL . ", apm_cancel_at = '$cancelAt'  where $this->idTable = ? and ctm_id = ?");
            $stm->bind_param('ii', $idApm,$idCtm);
            if ($stm->execute() && !$stm->errno) {
                $stm->close();
                $conn->close();
                return true;
            } else {
                throw new mysqli_sql_exception("Statement error: " . $stm->error);
            }
        } catch (Exception $e) {
            $stm->close();
            $conn->close();
            echo ("Error: " . $e->getMessage());
            return false;
        }
    }

    public function count_data($key){
        return $this->get_data($key) != null ? count($this->get_data($key)) : 0;
    }

    public function update_data($data, $id)
    {
        return $this->update($data, $id);
    }
};
