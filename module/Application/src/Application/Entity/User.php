<?php

namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class User {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $fullName;

    // getters/setters
    
    public function getId() {
        return $this->id;
    }

    public function getFullName($p) {
        $this->fullName = $p;
    }
    
    public function setFullName($p) {
        $this->fullName = $p;
    }
}