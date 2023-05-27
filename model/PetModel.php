<?php
//include("BaseModel.php");
class PetModel extends BaseModel
{

    private $connection;
    var $table = 'pet';
    var $idTable = 'pet_id';
    var $view = 'view_pet';
    var $viewJoin = 'view_pet_join';
    var $insert = ['pet_name', 'pet_type', 'pet_species', 'pet_gender', 'pet_note', 'ctm_id'];

    public function __construct()
    {
        //$this->connection = $this->get_connection();
    }

    public function get_data($key)
    {
        $result = $this->find_all($key);
        return $result;
    }
    public function count_data($key){
        return $this->get_data($key) != null ? count($this->get_data($key)) : 0;
    }
    public function get_by_id($id)
    {
        return $this->find_by_id($id);
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

    public function save_data($data)
    {
        $value = "'" . $data['name'] . "'," . $data['type'] . ",'" . $data['species'] . "'," . $data['gender'] . ",'" . $data['note'] . "'," . $data['ctm'];
        return $this->save($value);
    }

    public function update_data($data, $id)
    {
        return $this->update($data, $id);
    }
};
