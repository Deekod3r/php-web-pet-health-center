<?php 
class BaseRepository {

    protected $table;

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
        global $table;
        $query = "SELECT * FROM " . $this->table;
        $result = $this->getConnection()->query($query);
        $data = [];
        if($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }
}