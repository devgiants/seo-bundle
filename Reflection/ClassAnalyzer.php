<?php

/**
 * This file is part of the KnpDoctrineBehaviors package.
 *
 * (c) KnpLabs <http://knplabs.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Devgiants\SeoBundle\Reflection;

class ClassAnalyzer extends \Knp\DoctrineBehaviors\Reflection\ClassAnalyzer
{   
    /**
     * Return TRUE if the given object use the given trait, FALSE if not
     * Extends from ClassAnalyzer::hasTrait to check in ancestors traits as well
     * 
     * @param \ReflectionClass $class
     * @param string $traitName
     * @param boolean $isRecursive
     */
    public function hasTrait(\ReflectionClass $class, $traitName, $isRecursive = false)
    {
        $classTraits = $class->getTraitNames();
        // Trait directly present in final class
        if (in_array($traitName, $classTraits)) {
            return true;
        }

        // Check in parents traits
        foreach($classTraits as $classTrait) {
            $traitObject = new \ReflectionClass($classTrait);

            if($this->hasTrait($traitObject, $traitName, $isRecursive)) {
                return true;
            }
        }

        // Check in parents classes
        $parentClass = $class->getParentClass();

        if ((false === $isRecursive) || (false === $parentClass) || (null === $parentClass)) {
            return false;
        }

        return $this->hasTrait($parentClass, $traitName, $isRecursive);
    }
}
