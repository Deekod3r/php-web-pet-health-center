<?php
class BaseModel
{

    protected $table;
    protected $view;
    protected $insert;
    protected $selectView;
    protected $update;
    protected $idTable;
    protected $fieldTable;

    protected function get_connection()
    {
        $hostname = "localhost";
        $username = "root";
        $password = "123456";
        $database = "web_shop_pet";
        try {
            $conn = new mysqli($hostname, $username, $password, $database);
            if ($conn->connect_error) {
                throw new mysqli_sql_exception("Connection error: " . $conn->connect_error);
            } else {
                return $conn;
            }
        } catch (mysqli_sql_exception $e) {
            echo ("Error: " . $e->getMessage());
        }
    }

    protected function find_all($key)
    {
        $response = null;
        $conn = $this->get_connection();
        try {
            $stm = $conn->prepare("SELECT * FROM  {$this->table} where is_delete = 0 {$key}");
            if ($stm->execute() && !$stm->errno) {
                $result = $stm->get_result();
                $data = [];
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $data[] = $row;
                    }
                    $response = $data;
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

    protected function find_by_id($id)
    {
        $response[] = null;
        $conn = $this->get_connection();
        try {
            $stm = $conn->prepare("SELECT * FROM  {$this->table} WHERE {$this->idTable} = ? and is_delete = 0");
            $stm->bind_param('i', $id);
            if ($stm->execute() && !$stm->errno) {
                $result = $stm->get_result();
                if ($result->num_rows > 0) {
                    $response = $result->fetch_assoc();
                };
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

    protected function save($data)
    {
        $conn = $this->get_connection();
        try {
            $stm = $conn->prepare("Insert into $this->table (" . implode(",", $this->insert) . ") values ( {$data} )");
            if (!$stm->execute() || $stm->errno) {
                throw new mysqli_sql_exception("Statement error: " . $stm->error);
            } else {
                $stm->close();
                $conn->close();
                return true;
            }
        } catch (mysqli_sql_exception $e) {
            echo ("Error: " . $e->getMessage());
            $stm->close();
            $conn->close();
            return false;
        }
    }

    protected function delete($id)
    {
        $conn = $this->get_connection();
        try {
            $stm = $conn->prepare("Delete from $this->table where $this->idTable = ?");
            $stm->bind_param('i', $id);
            if (!$stm->execute() || $stm->errno) {
                throw new mysqli_sql_exception("Statement error: " . $stm->error);
            } else {
                $stm->close();
                $conn->close();
                return true;
            }
        } catch (mysqli_sql_exception $e) {
            echo ("Error: " . $e->getMessage());
            $stm->close();
            $conn->close();
            return false;
        }
    }

    protected function delete_soft($id)
    {
        $conn = $this->get_connection();
        try {
            $stm = $conn->prepare("update $this->table set is_delete = true where $this->idTable = ?");
            $stm->bind_param('i', $id);
            if (!$stm->execute() || $stm->errno) {
                throw new mysqli_sql_exception("Statement error: " . $stm->error);
            } else {
                $stm->close();
                $conn->close();
                return true;
            }
        } catch (mysqli_sql_exception $e) {
            echo ("Error: " . $e->getMessage());
            $stm->close();
            $conn->close();
            return false;
        }
    }

    protected function update($data, $id)
    {
        $conn = $this->get_connection();
        try {
            $strSet = 'set ';
            foreach ($data as $key => $value) {
                if (is_string($value)) {
                    $strSet .= $key . "='" . $value . "',";
                } else $strSet .= $key . "=" . $value .",";
            }
            //echo "update $this->table {$strSet} where $this->idTable = ?";
            $strSet = rtrim($strSet,",");
            $stm = $conn->prepare("update $this->table {$strSet} where $this->idTable = ?");
            $stm->bind_param('i', $id);
            if (!$stm->execute() || $stm->errno) {
                throw new mysqli_sql_exception("Statement error: " . $stm->error);
            } else {
                $stm->close();
                $conn->close();
                return true;
            }
        } catch (mysqli_sql_exception $e) {
           echo ("Error: " . $e->getMessage());
           $stm->close();
           $conn->close();
           return false;
        }
    }
}
