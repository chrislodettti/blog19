<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Comment;
use App\Entity\Post;
use App\Form\CommentType;

class CommentController extends Controller
{
    /**
     * @Route("/post/{thispost}/addcomment", name="addcomment")
     */
    public function newComment(Request $request){
        
       $comment=new Comment();
       $user=$this->getUser();
       //post
       $stringid = $request->attributes->get('thispost');
       $postid = (int)$stringid;
       $repository = $this->getDoctrine()->getRepository(Post::class);
       $post = $repository->find($postid);
       $s=date("Y-m-d H:i:s");
        $date = date_create_from_format('Y-m-d H:i:s', $s);
        $date->getTimestamp();
       
       
       $comment->setUser($user);
       $comment->setPost($post);
       $comment->setCreate_date($date);
       $form = $this->createForm(CommentType::class, $comment); 
       
        //formulario
       $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()) {
           $comment=$form->getData();
           $em = $this->getDoctrine()->getManager();
           $em->persist($comment);
           $em->flush();
           return $this->redirectToRoute('homeaction');
       }
           return $this->render('comment/createcomment.html.twig', array(
            'user'=>$user,
            'post'=>$post,
            'form' => $form->createView()            
        ));
    }
}
