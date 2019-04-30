<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
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
    private $title;
    /**
     *@ORM\Column(type="text")
     */
    private $content;
    /**
     *@ORM\Column(type="datetime")
     */
    private $create_date;   
    
    
    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\User",inversedBy="posts")
    * @ORM\JoinColumn(nullable=true)
    */
    private $user;
    public function getUser_id(){
    return $this->user;
    }
    function setUser($user) {
        $this->user = $user;
    }

    /**
     * Many Posts have Many Tags.
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="posts", cascade={"persist"})
     * @ORM\JoinTable(name="post_tags")
     */
    private $tags;


    /**
     *@ORM\OneToMany(targetEntity= "App\Entity\Comment",mappedBy="post")
     */
    private $comments;
    public function getComments(){
        return $this->comments;
    }
    
    
    function getTitle() {
        return $this->title;
    }

    function getContent() {
        return $this->content;
    }

    function getCreate_date() {
        return $this->create_date;
    }
    function getCreatedate() {
        return $this->create_date;
    }


    function getTags() {
        return $this->tags;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setContent($content) {
        $this->content = $content;
    }

    function setCreatedate($create_date) {
        $this->create_date = $create_date;
    }


    function setTags($tags) {
        $this->tags = $tags;
    }
    public function __construct(){
    $this->user=new ArrayCollection();
    $this->tags = new ArrayCollection();
    $this->comments=new ArrayCollection();
    }
    function getId() {
        return $this->id;
    }



}
