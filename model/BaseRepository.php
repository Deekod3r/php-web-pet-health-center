<?php 

//include("config/Enum/Enum.php");
class BaseRepository {

    protected $table;
    protected $view;
    protected $insert;
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

    protected function findAll($key){
        if(empty($key)) {
            $query = "SELECT * FROM " . $this->table . " where is_delete = 0";
        } else $query = "SELECT * FROM " . $this->table . " where is_delete = 0 " . $key;
        $response = null;
        $result = $this->getConnection()->query($query);
        $data = [];
        if($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $response = $data;
        } 
        return $response;
    }

    protected function findById($id){
        $query = "SELECT * FROM " . $this->table . " WHERE $this->id_table = " . $id . " and is_delete = 0";
        $response = [];
        $result = $this->getConnection()->query($query);
        if($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $response[] = $row;
            }
        } 
        return $response[0];
    }

    protected function save($data){
        $query = "Insert into " . $this->table . " (" . implode(",", $this->insert) .") values (" . $data .")";
        //echo $query;
        if($this->getConnection()->query($query)){
            return true;            
        } else return false;
    }

    protected function delete($id){
        $query = "Delete from $this->table where $this->id_table = " . $id;
        if($this->getConnection()->query($query)){
            return true;
        } else return false;
    }

    protected function deleteSoft($id){
        $query = "update $this->table set is_delte = true where $this->id_table = " . $id;
        if($this->getConnection()->query($query)){
            return true;
        } else return false;
    }

    protected function update($data, $id){
        $query = "Update $this->table ".
                "set ".
                "set "
                ." where $this->id_table = " . $id;
        if($this->getConnection()->query($query)){
                return true;
        } else return false;
    } 

}   