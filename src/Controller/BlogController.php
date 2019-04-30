<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
 
use App\Entity\Post;


/**
 * Description of BlogController
 *
 * @author linux
 */
class BlogController extends Controller{
    /**
     * @Route("/blog/{name}",name="blog_list")
     */
    public function listAction($name=null){
        
        $posts=[
            'test'=>['demodemodemo','demodemodemo'],
            'cla'=>['Because your users will need to edit and create posts, youre going to need to build a form. But before you begin, first focus on the generic Post class that represents and stores the data for a single post','ealing with HTML forms is one of the most common - and challenging - tasks for a web developer. Symfony integrates a Form component that makes dealing with forms easy. '],
            'ThirdUser'=>['lopapa','ifhjghkaa']
            
            ];
        
        if($name!=null){
            if(array_key_exists($name, $posts)){
                $data=$posts[$name];
            }else{
                $data=null;
            }
            
        }
        
        
        return $this->render('blog/index.html.twig',['posts'=>$data,'name'=>$name]);  
    }
    /**
     * @Route("/blog/post/new",name="new_post")
     * 
     */
    
    public function newPost(Request $request){
        $post = new Post();

        $post->setTitle('Write a blog title post');
        //crear formulario:
        $form = $this->createFormBuilder($post)
            ->add('title', TextType::class)
            ->add('content', TextType::class)
                ->add('user', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Post'))
            ->getForm();
 
        // handle the request
        $form->handleRequest($request);
        //comprobar validez de envio
        if($form->isSubmitted() && $form->isValid()){
            $post=$form->getData();
            //ENTITY MANAGER
            //$em->$this->getDoctrine()->getManager();
            //$em->persist($post);
            //$em->flush();
            return $this->redirectToRoute('homeaction');
            
        }
        return $this->render('blog/post_form.html.twig', ['form'=>$form->createView()]);
    }
}
