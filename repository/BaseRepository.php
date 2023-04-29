<?php 

//include("config/Enum/Enum.php");
class BaseRepository {

    protected $table;
    protected $id_table;
    protected $field_table;
    protected function getConnection() {
        $hostname = "localhost";
        $username = "root";
        $password = "123456";
        $database = "web_shop_pet";

        $conn = new mysqli($hostname, $username, $password, $database);
        if($conn->connect_error) {
            die("Connection error: " . $conn->connect_error);
        }
        return $conn;
    }

    protected function findAll(){
        $query = "SELECT * FROM " . $this->table . " where is_delete = 0";
        $result = null;
        $response = null;
        try{
            $result = $this->getConnection()->query($query);
            $data = [];
            if($result->num_rows >= 0) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                $response = $data;
            } else $response = null;
        } catch(Exception $e) {
        }
        return $response;
    }

    protected function findById($id){
        $query = "SELECT * FROM " . $this->table . " WHERE $this->id_table = " . $id . " and is_delete = 0";
        $result = null;
        $response = null;
        try{
            $result = $this->getConnection()->query($query);
            $data = [];
            if($result->num_rows >= 0) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                $response = $data;
            } else return null;
        }catch(Exception $e){
        }
        return $response;
    }

    protected function save($data){
        $query = "Insert into " . $this->table . " values(" . implode(",", $data) . ")";
        try {
            if($this->getConnection()->query($query)){
                return true;            
            } else return false;
        } catch (Exception $e){
        }
        return false;
    }

    protected function delete($id){
        $query = "Delete from $this->table where $this->id_table = " . $id;
        try {
            if($this->getConnection()->query($query)){
                return true;
            } else return false;
        } catch (Exception $e){
        }
        return false;
    }

    protected function update($data, $id){
        $query = "Update $this->table ".
                "set ".
                "set "
                ." where $this->id_table = " . $id;
        try {
            if($this->getConnection()->query($query)){
                return true;
            } else return false;
        } catch (Exception $e){
        }
        return false;
    }

}   