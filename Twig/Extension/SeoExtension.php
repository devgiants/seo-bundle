<?php

namespace Devgiants\SeoBundle\Twig\Extension;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class SeoExtension
 */
class SeoExtension extends \Twig_Extension
{

    private $container;

    public function __construct(ContainerInterface $container)
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
            'getClassName' => new \Twig_SimpleFunction(
                'getClassName',
                array($this, 'getClassName')
            )
        );
    }

    /**
     *  Return front url of the entity
     *  @param  entity  $entity The entity to get front url
     *  @return string  Url
     */
    public function getFrontUrlRedirection($entity)
    {
        return $this->container->get('Devgiants.seo.tools')->getFrontUrlRedirection(
            $entity->getId(), 
            $entity->getSlug(),
            (new \ReflectionClass($entity))->getShortName()
        );
    }

    /**
     *  Return the class name on entity in parameter
     *  @param  entity  $entity The entity to get class name
     *  @return string  Class name
     */
    public function getClassName($entity)
    {
        return (new \ReflectionClass($entity))->getShortName();
    }

}