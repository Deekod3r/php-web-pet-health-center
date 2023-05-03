<?php 
class DetailService {
    private $id;
    private $sv_id;
    private $mtr_id;
    private $quantity;
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
     * Get the value of sv_id
     */ 
    public function getSv_id()
    {
        return $this->sv_id;
    }

    /**
     * Set the value of sv_id
     *
     * @return  self
     */ 
    public function setSv_id($sv_id)
    {
        $this->sv_id = $sv_id;

        return $this;
    }

    /**
     * Get the value of mtr_id
     */ 
    public function getMtr_id()
    {
        return $this->mtr_id;
    }

    /**
     * Set the value of mtr_id
     *
     * @return  self
     */ 
    public function setMtr_id($mtr_id)
    {
        $this->mtr_id = $mtr_id;

        return $this;
    }

    /**
     * Get the value of quantity
     */ 
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */ 
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

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