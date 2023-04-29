<?php 
class News {
    private $id;
    private $title;
    private $description;
    private $content;
    private $img;
    private $date_release;
    private $active;
    private $is_delete;
    private $ad_id;
    private $cn_id;

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
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

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
     * Get the value of img
     */ 
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set the value of img
     *
     * @return  self
     */ 
    public function setImg($img)
    {
        $this->img = $img;

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
     * Get the value of cn_id
     */ 
    public function getCn_id()
    {
        return $this->cn_id;
    }

    /**
     * Set the value of cn_id
     *
     * @return  self
     */ 
    public function setCn_id($cn_id)
    {
        $this->cn_id = $cn_id;

        return $this;
    }
}