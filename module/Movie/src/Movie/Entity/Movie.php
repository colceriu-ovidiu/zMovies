<?php

namespace Movie\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="movies")
*/
class Movie {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $title;
    
    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="movies")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;
    
    /** @ORM\Column(type="text", length=100) */
    protected $description;
    
    /** @ORM\Column(type="date") */
    protected $releaseDate;
    
    /** @ORM\Column(type="boolean") */
    protected $active;

    // getters/setters

    /**
     * @param mixed $id
     *
     * @return Movie 
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $title
     *
     * @return Movie 
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $category
     *
     * @return Movie 
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return mixed 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $description
     *
     * @return Movie 
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $releaseDate
     *
     * @return Movie 
     */
    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;
        return $this;
    }

    /**
     * @return mixed 
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * @param mixed $active
     *
     * @return Movie 
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return mixed 
     */
    public function getActive()
    {
        return $this->active;
    }

}