<?php

namespace Devgiants\SeoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SeoType extends AbstractType
{
    /**
     * The form name
     */
    const NAME = 'devgiants_seobundle_seo';

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('seoTitle', TextType::class, array(
                'label' => 'seo.form.title.name',
                'required' => false,
            ))
            ->add('seoDescription', TextType::class, array(
                'label' => 'seo.form.description.name',
                'required' => false,
            ))
            ->add('slug', TextType::class, array(
                'required' => true,
                'label' => 'seo.form.url.name',
            ))
        ;
    }
    
    /**
    *   inherit_data : https://symfony.com/doc/2.8/cookbook/form/inherit_data_option.html
    */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'inherit_data' => true,
        ));
    }


    /**
     * @param FormView $view
     * @param FormInterface $form
     * @param array $options
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        parent::buildView($view, $form, $options);

//        $view->vars = array_merge($view->vars, array(
//            'entity' => $options['entity']
//        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return self::NAME;
    }
}
