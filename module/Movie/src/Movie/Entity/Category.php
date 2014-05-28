<?php

namespace Movie\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="categories")
*/
class Category {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Movie", mappedBy="category")
     */
    private $movies;
    
    /** @ORM\Column(type="string") */
    protected $title;
    
    /** @ORM\Column(type="boolean", options={"default" = 0} ) */
    protected $active = 0;
    
    public function __construct() {
        $this->movies = new \Doctrine\Common\Collections\ArrayCollection();
    }    

    // getters/setters

    /**
     * @return mixed 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $movies
     *
     * @return Category 
     */
    public function setMovies($movies)
    {
        $this->movies = $movies;
        return $this;
    }

    /**
     * @return mixed 
     */
    public function getMovies()
    {
        return $this->movies;
    }

    /**
     * @param mixed $title
     *
     * @return Category 
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
     * @param mixed $active
     *
     * @return Category 
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