<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity(repositoryClass="App\Repository\TagRepository")
 */
class Tag
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
    private $tagname;
     /**
     * Many Tags have Many Posts.
     * @ORM\ManyToMany(targetEntity="Post", mappedBy="tags")
     */

    private $posts;
    function __construct() {
        $this->posts=new ArrayCollection();
    }
    
    function getTagname() {
        return $this->tagname;
    }

    function setTagname($tagname) {
        $this->tagname = $tagname;
    }

    function getPosts() {
        return $this->posts;
    }

    function setPosts($posts) {
        $this->posts = $posts;
    }

    function getId() {
        return $this->id;
    }

    public function __toString(){
        return $this->tagname;
    }

}
