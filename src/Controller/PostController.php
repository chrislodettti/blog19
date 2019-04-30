<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Post;
use App\Form\PostType;

class PostController extends Controller
{
    /**
     * @Route("/post", name="post")
     */
    public function index()
    {
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }
    
    /**
     * @Route("/newpost", name="newpost")
     */
    public function newPost(Request $request){
        
       $post=new Post();
       $user=$this->getUser();
       $post->setUser($user);
       $form = $this->createForm(PostType::class, $post); 
       
        //formulario
       $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()) {
           $post=$form->getData();
           $em = $this->getDoctrine()->getManager();
           $em->persist($post);
           $em->flush();
           return $this->redirectToRoute('homeaction');
       }
           return $this->render('post/createpost.html.twig', array(
            'user'=>$user,   
            'form' => $form->createView()            
        ));
    }
    /**
     * @Route("/post/{thispost}",name="post")
     */
    public function thisPost($thispost){
        $posts = $this->getDoctrine()->getRepository('App:Post')->findAll();
        $users = $this->getDoctrine()->getRepository('App:User')->findAll();
        $comments = $this->getDoctrine()->getRepository('App:Comment')->findAll();
        
        return $this->render('post/thispost.html.twig',[
            'thispost'=> $thispost,
            'posts' => $posts,
            'comments' => $comments,
            'users' => $users]);
    }
    /**
     * @Route("/post/{thispost}/editpost", name="editpost")
     */
    public function editPosts(Request $request){
        
       //this post
       $stringid = $request->attributes->get('thispost');
       $postid = (int)$stringid;
       $repository = $this->getDoctrine()->getRepository(Post::class);
       $post = $repository->find($postid);
       $user = $this->getUser();
       $form = $this->createForm(PostType::class, $post); 
       
        //formulario
       $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()) {
           $post=$form->getData();
           $em = $this->getDoctrine()->getManager();
           $em->persist($post);
           $em->flush();
           return $this->redirectToRoute('homeaction');
       }
           return $this->render('post/editpost.html.twig', array(
            'user'=>$user,
            'post'=>$post,
            'form' => $form->createView()            
        ));
    }

}
