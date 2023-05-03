<?php 
class Feedback {
    private $id;
    private $content;
    private $rating;
    private $time;
    private $is_delete;
    private $ctm_id;

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
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content)
    {
        $this->content = $content;

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
     * Get the value of rating
     */ 
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set the value of rating
     *
     * @return  self
     */ 
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }
}