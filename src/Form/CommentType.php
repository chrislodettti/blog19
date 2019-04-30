<?php

 namespace App\Form;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
  
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

    use App\Entity\Comment;
    
        /**
 * Description of CommentType
 *
 * @author daw
 */
class CommentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            
            ->add('comment', null, [
                'label' => 'Comment',
                'required' => false,
                'attr'=>[ 
                                'class'=>'form-control'
                        ]
            ])
                
                ->add('Signup', SubmitType::class,
                            ['label'=>'Save',
                                'attr'=>[ 
                                'class'=>'form-submit btn btn-success'
                        ]]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}