<?php

namespace Security\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="users")
*/
class User {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;
    
    /** @ORM\Column(type="string") */
    protected $username = '';
    
    /** @ORM\Column(type="string") */
    protected $password = '';

    /** @ORM\Column(type="string") */
    protected $role;

    /** @ORM\Column(type="boolean", options={"default" = 0} ) */
    protected $active = 0;  



    /**
     * @param mixed $id
     *
     * @return Admin 
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

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    
    public function setPassword($plaintextPassword, $salt)
    {
        $this->password = crypt($plaintextPassword, '$5$rounds=5000$'.$salt.'$');
        return $this;
    }

    public static function hashPassword($player, $password)
    {
        return ($player->getPassword() === crypt($password, $player->getPassword()));
    }    
    
    /**
     * @param mixed $active
     *
     * @return Admin 
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
    
    /**
     * @param mixed $role
     *
     * @return Admin 
     */
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }
    

}