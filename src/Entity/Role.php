<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoleRepository")
 */
class Role
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    // add your own fields
    
    /**
     *@ORM\Column(type="string",length=45)
     */
    private $rol;
    /**
     *@ORM\Column(type="string",length=45)
     */
    private $description;
    
    public function getUsers(){
        return $this->users;
    }
    function getId() {
        return $this->id;
    }

    function getRol() {
        return $this->rol;
    }

    function getDescription() {
        return $this->description;
    }

    function setRol($rol) {
        $this->rol = $rol;
    }

    function setDescription($description) {
        $this->description = $description;
    }



}
