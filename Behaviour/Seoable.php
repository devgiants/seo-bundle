<?php
namespace Devgiants\SeoBundle\Behaviour;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 13/01/16
 * Time: 17:53
 */
trait Seoable {

    use ORMBehaviors\Sluggable\Sluggable,
        SeoProperties,
        SeoMethods;
}