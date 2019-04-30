<?php

    namespace App\Form;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
    use App\Form\Type\TagsInputType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use App\Entity\Post;
    
    /**
 * Description of PostType
 *
 * @author linux
 */
class PostType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // For the full reference of options defined by each form field type
        // see https://symfony.com/doc/current/reference/forms/types.html

        // By default, form fields include the 'required' attribute, which enables
        // the client-side form validation. This means that you can't test the
        // server-side validation errors from the browser. To temporarily disable
        // this validation, set the 'required' attribute to 'false':
        // $builder->add('title', null, ['required' => false, ...]);

        $builder
            ->add('title', null, [
                'attr' => ['autofocus' => true],
                'label' => 'Title',
                'attr'=>[ 
                                'class'=>'form-control'
                        ]
            ])
            ->add('content', null, [
                'label' => 'Content',
                'required' => false,
                'attr'=>[ 
                                'class'=>'form-control'
                        ]
            ])
            ->add('create_date', DateTimeType::class, [
                'label' => 'Published at',
                'widget'=>'single_text',
                'attr'=>[ 
                                'class'=>'form-control js-datepicker'
                        ]
            ])
            ->add('tags', TagsInputType::class, [
                'label' => 'Tags',
                
                'required' => false,
                'attr'=>[ 
                                'data-role'=>'tagsinput',
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
            'data_class' => Post::class,
        ]);
    }
}
