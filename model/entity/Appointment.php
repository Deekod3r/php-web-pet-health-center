<?php 
class Appointment {
    private $id;
    private $date;
    private $time;
    private $status;
    private $ctm_id;
    private $cs_id;
    private $is_delete;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of time
     */ 
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set the value of time
     *
     * @return  self
     */ 
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of ctm_id
     */ 
    public function getCtm_id()
    {
        return $this->ctm_id;
    }

    /**
     * Set the value of ctm_id
     *
     * @return  self
     */ 
    public function setCtm_id($ctm_id)
    {
        $this->ctm_id = $ctm_id;

        return $this;
    }

    /**
     * Get the value of cs_id
     */ 
    public function getCs_id()
    {
        return $this->cs_id;
    }

    /**
     * Set the value of cs_id
     *
     * @return  self
     */ 
    public function setCs_id($cs_id)
    {
        $this->cs_id = $cs_id;

        return $this;
    }

    /**
     * Get the value of is_delete
     */ 
    public function getIs_delete()
    {
        return $this->is_delete;
    }

    /**
     * Set the value of is_delete
     *
     * @return  self
     */ 
    public function setIs_delete($is_delete)
    {
        $this->is_delete = $is_delete;

        return $this;
    }
}