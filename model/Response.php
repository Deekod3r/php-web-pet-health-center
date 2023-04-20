<?php 

Class Response {
    private $id_response;
    private $message_response;
    private $data_response;
    private $status_response;
    

    public function __construct($id_response, $message_response, $data_response, $status_response){
        $this->id_response = $id_response;
        $this->message_response = $message_response;
        $this->data_response = $data_response;
        $this->status_response = $status_response;
    }

    /**
     * Get the value of id_response
     */ 
    public function getId_response()
    {
        return $this->id_response;
    }

    /**
     * Set the value of id_response
     *
     * @return  self
     */ 
    public function setId_response($id_response)
    {
        $this->id_response = $id_response;

        return $this;
    }

    /**
     * Get the value of message_response
     */ 
    public function getMessage_response()
    {
        return $this->message_response;
    }

    /**
     * Set the value of message_response
     *
     * @return  self
     */ 
    public function setMessage_response($message_response)
    {
        $this->message_response = $message_response;

        return $this;
    }

    /**
     * Get the value of data_response
     */ 
    public function getData_response()
    {
        return $this->data_response;
    }

    /**
     * Set the value of data_response
     *
     * @return  self
     */ 
    public function setData_response($data_response)
    {
        $this->data_response = $data_response;

        return $this;
    }

    /**
     * Get the value of status_response
     */ 
    public function getStatus_response()
    {
        return $this->status_response;
    }

    /**
     * Set the value of status_response
     *
     * @return  self
     */ 
    public function setStatus_response($status_response)
    {
        $this->status_response = $status_response;

        return $this;
    }


}