<?php
namespace devGiants\SeoBundle\Behaviour;

use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 13/01/16
 * Time: 17:53
 */
trait Seoable {

    use ORMBehaviors\Sluggable\Sluggable;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_title", type="string", length=60, nullable=true)
     * @Assert\Length(
     *      min = 1,
     *      max = 55,
     *      minMessage = "seo.validations.seoTitle.minLenth ( {{limit}} )", payload = {"severity" = "warning"} ),
     *      maxMessage = "seo.validations.seoTitle.maxLenth ( {{limit}} )", payload = {"severity" = "warning"} )
     * )
     */
    private $seoTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_description", type="text",nullable=true)
     * @Assert\Length(
     *      min = 0,
     *      max = 160,
     *      minMessage = "seo.validations.seoDescription.minLenth ( {{limit}} )", payload = {"severity" = "warning"}  ),
     *      maxMessage = "seo.validations.seoDescription.maxLenth ( {{limit}} )", payload = {"severity" = "warning"}  )
     * )
     */
    private $seoDescription;

    /**
     * @return string
     */
    public function getSeoTitle()
    {
        return $this->seoTitle;
    }

    /**
     * @param string $seoTitle
     */
    public function setSeoTitle($seoTitle)
    {
        $this->seoTitle = $seoTitle;
    }

    /**
     * @return string
     */
    public function getSeoDescription()
    {
        return $this->seoDescription;
    }

    /**
     * @param string $seoDescription
     */
    public function setSeoDescription($seoDescription)
    {
        $this->seoDescription = $seoDescription;
    }
}