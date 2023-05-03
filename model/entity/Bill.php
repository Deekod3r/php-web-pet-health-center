<?php 
class Bill {
    private $id;
    private $date_release;
    private $is_delete;
    private $status;
    private $ctm_id;
    private $ad_id;
    private $dc_code;
    private $total_value;

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
     * Get the value of date_release
     */ 
    public function getDate_release()
    {
        return $this->date_release;
    }

    /**
     * Set the value of date_release
     *
     * @return  self
     */ 
    public function setDate_release($date_release)
    {
        $this->date_release = $date_release;

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
     * Get the value of ad_id
     */ 
    public function getAd_id()
    {
        return $this->ad_id;
    }

    /**
     * Set the value of ad_id
     *
     * @return  self
     */ 
    public function setAd_id($ad_id)
    {
        $this->ad_id = $ad_id;

        return $this;
    }

    /**
     * Get the value of dc_code
     */ 
    public function getDc_code()
    {
        return $this->dc_code;
    }

    /**
     * Set the value of dc_code
     *
     * @return  self
     */ 
    public function setDc_code($dc_code)
    {
        $this->dc_code = $dc_code;

        return $this;
    }

    /**
     * Get the value of total_value
     */ 
    public function getTotal_value()
    {
        return $this->total_value;
    }

    /**
     * Set the value of total_value
     *
     * @return  self
     */ 
    public function setTotal_value($total_value)
    {
        $this->total_value = $total_value;

        return $this;
    }
}