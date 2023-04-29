<?php 
class DetailBill {
    private $id;
    private $bill_id;
    private $sv_id;
    private $quantity;
    private $sv_price;
    private $pet_id;
    private $value;
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
     * Get the value of bill_id
     */ 
    public function getBill_id()
    {
        return $this->bill_id;
    }

    /**
     * Set the value of bill_id
     *
     * @return  self
     */ 
    public function setBill_id($bill_id)
    {
        $this->bill_id = $bill_id;

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
     * Get the value of sv_price
     */ 
    public function getSv_price()
    {
        return $this->sv_price;
    }

    /**
     * Set the value of sv_price
     *
     * @return  self
     */ 
    public function setSv_price($sv_price)
    {
        $this->sv_price = $sv_price;

        return $this;
    }

    /**
     * Get the value of pet_id
     */ 
    public function getPet_id()
    {
        return $this->pet_id;
    }

    /**
     * Set the value of pet_id
     *
     * @return  self
     */ 
    public function setPet_id($pet_id)
    {
        $this->pet_id = $pet_id;

        return $this;
    }

    /**
     * Get the value of value
     */ 
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value of value
     *
     * @return  self
     */ 
    public function setValue($value)
    {
        $this->value = $value;

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