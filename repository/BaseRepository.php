<?php 

use Response;
use Constant;
class BaseRepository {

    protected $table;
    protected $id_table;

    private $constant = new Constant();
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
        $query = "SELECT * FROM " . $this->table;
        $result = null;
        $response = null;
        try{
            $result = $this->getConnection()->query($query);
            $data = [];
            if($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                $response = new Response(uniqid($this->constant::RESPONSE_SEARCH), $this->constant::SEARCH_MESSAGE_SUCCESS, $data, 200);
            } else throw new Exception();
        } catch(Exception $e){
            $response = new Response(uniqid($this->constant::RESPONSE_SEARCH),$this->constant::SEARCH_MESSAGE_FAIL,$result,501);
        }
        return $response;
    }

    protected function findById($id){
        $query = "SELECT * FROM " . $this->table . " WHERE $this->id_table = " . $id;
        $result = null;
        $response = null;
        try{
            $result = $this->getConnection()->query($query);
            $data = [];
            if($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                $response = new Response(uniqid($this->constant::RESPONSE_SEARCH), $this->constant::SEARCH_MESSAGE_SUCCESS, $data, 200);
            } else throw new Exception();
        }catch(Exception $e){
            $response = new Response(uniqid($this->constant::RESPONSE_SEARCH),$this->constant::SEARCH_MESSAGE_FAIL,null,501);
        }
        return $response;
    }

    protected function save($data){
        $query = "Insert into " . $this->table . " values(" . implode(",", $data) . ")";
        $response = null;
        try {
            if($this->getConnection()->query($query)){
                $response = new Response(uniqid($this->constant::RESPONSE_INSERT),$this->constant::INSERT_MESSAGE_SUCCESS,true,200);
            } else throw new Exception();
        } catch (Exception $e){
            $response = new Response(uniqid($this->constant::RESPONSE_INSERT),$this->constant::INSERT_MESSAGE_FAIL,true,501);        
        }
        return $response;
    }

    protected function delete($id){
        $query = "Delete from $this->table where $this->id_table = " . $id;
        $response = null;
        try {
            if($this->getConnection()->query($query)){
                $response = new Response(uniqid($this->constant::RESPONSE_DELETE),"Delete success.",true,200);
            } else throw new Exception("Delete fail.");
        } catch (Exception $e){
            $response = new Response(uniqid($this->constant::RESPONSE_DELETE),$e->getMessage(),true,501);        
        }
        return $response;
    }

    protected function update($data, $id){
        $query = "Delete from $this->table where $this->id_table = " . $id;
        $response = null;
        try {
            if($this->getConnection()->query($query)){
                $response = new Response(uniqid($this->constant::RESPONSE_DELETE),"Delete success.",true,200);
            } else throw new Exception("Delete fail.");
        } catch (Exception $e){
            $response = new Response(uniqid($this->constant::RESPONSE_DELETE),$e->getMessage(),true,501);        
        }
        return $response;
    }

    
}   