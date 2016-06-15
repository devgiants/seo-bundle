<?php
/**
 * @author Lusitanian
 * Freely released with no restrictions, re-license however you'd like!
 */

namespace devGiants\SeoBundle\ORM;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Knp\DoctrineBehaviors\Reflection\ClassAnalyzer;

use Knp\DoctrineBehaviors\ORM\AbstractSubscriber;

use Doctrine\ORM\Event\LoadClassMetadataEventArgs,
    Doctrine\Common\EventSubscriber,
    Doctrine\ORM\Events,
    Doctrine\ORM\Mapping\ClassMetadata;

/**
 * Sluggable subscriber.
 *
 * Adds mapping to sluggable entities.
 */
class SeoableSubscriber extends AbstractSubscriber
{
    private $seoableTrait;

    public function __construct(ClassAnalyzer $classAnalyzer, $seoableTrait)
    {
        parent::__construct($classAnalyzer, true);
        $this->seoableTrait = $seoableTrait;
    }


    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        $classMetadata = $eventArgs->getClassMetadata();

        if (null === $classMetadata->reflClass) {
            return;
        }

        if ($this->isSeoable($classMetadata)) {
            if (!$classMetadata->hasField('seoTitle')) {
                $classMetadata->mapField(array(
                    'fieldName' => 'seoTitle',
                    'type'      => 'string',
                    'nullable'  => true
                ));
            }
            if (!$classMetadata->hasField('seoDescription')) {
                $classMetadata->mapField(array(
                    'fieldName' => 'seoDescription',
                    'type'      => 'string',
                    'nullable'  => true
                ));
            }
        }
    }

    public function getSubscribedEvents()
    {
        return [ Events::loadClassMetadata ];
    }

    /**
     * Checks if entity is seoable
     *
     * @param ClassMetadata $classMetadata The metadata
     *
     * @return boolean
     */
    private function isSeoable(ClassMetadata $classMetadata)
    {
        return $this->getClassAnalyzer()->hasTrait(
            $classMetadata->reflClass,
            $this->seoableTrait,
            true
        );
    }
}
