<?php

namespace Devgiants\SeoBundle\Form\Extension;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use LCH\SeoBundle\Form\SeoType;

/**
 * Class SeoTypeExtension
 * 
 * @package LCH\SeoBundle\Form\Extension
 */
class SeoTypeExtension extends AbstractTypeExtension
{

    /**
     * Returns the name of the type being extended.
     *
     * @return string The name of the type being extended
     */
    public function getExtendedType()
    {
        return SeoType::class;
    }

    // /**
    //  * Add the seo_title option
    //  *
    //  * @param OptionsResolver $resolver
    //  */
    // public function configureOptions(OptionsResolver $resolver)
    // {
    //     $resolver->setDefined(array('seo'));
    // }
}