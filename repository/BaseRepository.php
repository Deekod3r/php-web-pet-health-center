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

}