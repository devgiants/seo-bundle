<?php

namespace devGiants\SeoBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;

class Tools {

    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    /**
     * Slug function based on SluggableMethods of Knp\DoctrineBehaviors\Model\Sluggable
     * @param  string  $toSlug to slug
     * @return  string $urlized The slug
     */
    public function getSlug($toSlug)
    {
        $slugDelimiter = '-';

        $toSlug = $this->removeAccent($toSlug);

        $urlized = strtolower( trim( preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $toSlug ), $slugDelimiter ) );
        $urlized = preg_replace("/[\/_|+ -]+/", $slugDelimiter, $urlized);

        return $urlized;
    }

    /**
     *  Remove accents
     *  
     *  @param  string  $str        String
     *  @param  string  $charset    Charset
     */
    public function removeAccent($str, $charset='utf-8')
    {
        $str = htmlentities($str, ENT_NOQUOTES, $charset);
        
        $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
        $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
        $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères
        
        return $str;
    }

    /**
     *  Return front url of the entity 
     *  
     *  @param  string  $id          Id of the entity
     *  @param  string  $slug        Slug of the entity
     *  @param  string  $entityClass Class name of the entity
     *  
     *  @return String  The url of entity
     */
    public function getFrontUrlRedirection($id, $slug, $entityClass)
    {
        $currentSite = $this->container->get('session')->get('currentSite');

        switch ($entityClass) {
            case 'Offer':
                $entityUrl = $this->container->get('router')->generate('lch_app_offer_front_show', array('id' => $id, 'slug' => $slug));
                break;
            case 'OfferCategory':
                $entityUrl = $this->container->get('router')->generate('lch_app_offercategory_front', array('id' => $id, 'slug' => $slug));
                break;
            case 'Testimonial':
                $entityUrl = $this->container->get('router')->generate('lch_app_testimonial_front', array('id' => $id, 'slug' => $slug));
                break;
            case 'Thematique':
                $entityUrl = $this->container->get('router')->generate('lch_app_thematique_front', array('id' => $id, 'slug' => $slug));
                break;
            case 'EventSell':
                $entityUrl = $this->container->get('router')->generate('lch_app_event_sell_front', array('id' => $id, 'slug' => $slug));
                break;
            default:
                $entityUrl = "/exemple/".$id."-".$slug;
                break;
        }

        return "http://".$currentSite->getDomainName().$entityUrl;
    }
}