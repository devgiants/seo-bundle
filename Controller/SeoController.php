<?php

namespace Devgiants\SeoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SeoController extends Controller
{
    /**
     * Get the slug of a string in AJAX
     * 
     * @param   $request    The request. String to slug must be sent in $request['toSlug'] 
     *
     * @return  $response   Response 
     */
    public function getSlugAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            if($toSlug = $request->get('toSlug')){
                $slug = $this->container->get('lch.seo.tools')->getSlug($toSlug);

                $em = $this->getDoctrine()->getManager();
                $currentSite = $request->getSession()->get('currentSite');

                if(class_exists('\\LCH\\CatalogBundle\\Entity\\'.$request->get('className'))){
                    $entitySlug = $em->getRepository('LCHCatalogBundle:'.$request->get('className'))->findOneBySlug($slug);
                }elseif (class_exists('\\LCH\\ModuleBundle\\Entity\\'.$request->get('className'))) {
                    $entitySlug = $em->getRepository('LCHModuleBundle:'.$request->get('className'))->findOneBySlug($slug);
                }else{
                    throw new NotFoundHttpException("Class ".$request->get('className')." no exists");
                }

                // if slug already exists
                $response = new JsonResponse();

                $id = $request->get('id') != "" ? $request->get('id') : "0";

                $url = $this->container->get('lch.seo.tools')->getFrontUrlRedirection($id , $slug, $request->get('className'));

                if($entitySlug){
                    if($request->get('id') == $entitySlug->getId()){
                        // If the slug comes from the same entity
                        $response->setData(array(
                            'slug' => $slug,
                            'message' => $this->container->get('translator')->trans('seo.form.url.infos')." ".$url,
                        ));
                    }else{
                        $response->setData(array(
                            'slug' => $slug,
                            'error' => $this->container->get('translator')->trans("app.slugexists"),
                        ));  
                    }
                }else{
                    $response->setData(array(
                        'slug' => $slug,
                        'message' => $this->container->get('translator')->trans('seo.form.url.infos')." ".$url,
                    ));
                }
                return $response;
            }
        }
    }
}
