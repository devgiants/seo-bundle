<?php

namespace devGiants\SeoBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\Container;
use Doctrine\ORM\EntityManager;

/**
 * Class SeoExtension
 */
class SeoExtension extends \Twig_Extension
{

    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'seo_extension';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'getFrontUrlRedirection' => new \Twig_SimpleFunction(
                'getFrontUrlRedirection',
                array($this, 'getFrontUrlRedirection'),
                array('is_safe' => array('html'))
            ),
        );
    }

    /**
     *  Return front url of the entity 
     *  
     *  @param  entity  $entity The entity to get front url
     *  
     *  @return string  Url
     */
    public function getFrontUrlRedirection($entity)
    {
        return $this->container->get('lch.seo.tools')->getFrontUrlRedirection(
            $entity->getId(), 
            $entity->getSlug(),
            (new \ReflectionClass($entity))->getShortName()
        );
    }

}