<?php 
class Discount {
    private $code;
    private $description;
    private $condition;
    private $value;
    private $value_percent;
    private $start_time;
    private $end_time;
    private $quantity;
    private $active;
    private $is_delete;

    /**
     * Get the value of code
     */ 
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */ 
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of condition
     */ 
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * Set the value of condition
     *
     * @return  self
     */ 
    public function setCondition($condition)
    {
        $this->condition = $condition;

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
     * Get the value of value_percent
     */ 
    public function getValue_percent()
    {
        return $this->value_percent;
    }

    /**
     * Set the value of value_percent
     *
     * @return  self
     */ 
    public function setValue_percent($value_percent)
    {
        $this->value_percent = $value_percent;

        return $this;
    }

    /**
     * Get the value of start_time
     */ 
    public function getStart_time()
    {
        return $this->start_time;
    }

    /**
     * Set the value of start_time
     *
     * @return  self
     */ 
    public function setStart_time($start_time)
    {
        $this->start_time = $start_time;

        return $this;
    }

    /**
     * Get the value of end_time
     */ 
    public function getEnd_time()
    {
        return $this->end_time;
    }

    /**
     * Set the value of end_time
     *
     * @return  self
     */ 
    public function setEnd_time($end_time)
    {
        $this->end_time = $end_time;

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
     * Get the value of active
     */ 
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set the value of active
     *
     * @return  self
     */ 
    public function setActive($active)
    {
        $this->active = $active;

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