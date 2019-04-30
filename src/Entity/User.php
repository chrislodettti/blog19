<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
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
    private $username;
    /**
     *@ORM\Column(type="string",length=90)
     */
    private $email;
    /**
     *@ORM\Column(type="string",length=64)
     */
    private $password;
    /**
     *@ORM\Column(type="datetime")
     */
    private $lastlogin;
    /**
     *@ORM\Column(type="string",length=64)
     */
    private $role;
    
    function getRole() {
        return $this->role;
    }
    function setRole($role){
        $this->role=$role;
    }

    
    /**
    *@ORM\OneToMany(targetEntity="App\Entity\Post",mappedBy="user")
    *@ORM\JoinColumn(nullable=true)
    */
    private $posts;
    
    public function getPosts(){
    return $this->posts;
    }
    /**
     *@ORM\OneToMany(targetEntity= "App\Entity\Comment",mappedBy="user")
     */
    private $comments;
    public function getComments(){
        return $this->comments;
    }
    
    public function __construct(){
    $this->posts=new ArrayCollection();
    $this->comments=new ArrayCollection();
    }

    public function eraseCredentials() {
        
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRoles() {
        return array($this->role);
    }

    public function getSalt() {
        
    }

    public function getUsername() {
        return $this->username;
    }
    function getId() {
        return $this->id;
    }

    function getEmail() {
        return $this->email;
    }

    function getLastlogin() {
        return $this->lastlogin;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setLastlogin($lastlogin) {
        $this->lastlogin = $lastlogin;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setPosts($posts) {
        $this->posts = $posts;
    }



}
