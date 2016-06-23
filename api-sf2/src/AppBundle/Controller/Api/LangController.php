<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Languages;
use Doctrine\ORM\EntityRepository;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LangController extends BaseApiController
{
    /**
     *
     * @Get("/lang/", name="get_one")
     *
     * @param Request                            $request
     * @param ParamFetcher $paramFetcher
     *
     * @return Response
     */
    public function getLangAction (Request $request , ParamFetcher $paramFetcher)
    {
        return BaseApiController::listAction($request , $paramFetcher);
    }

    /**
     *
     * @Post("/lang/", name="post")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function postLangAction (Request $request)
    {
        return BaseApiController::createAction($request);
    }

    /**
     * @see BaseApiController::getRepository()
     * @return EntityRepository
     */
    public function getRepository ()
    {
        return $this->getDoctrine()->getManager()->getRepository('AppBundle:Lang');
    }

    /**
     * @see BaseApiController::getNewEntity()
     * @return Object
     */
    public function getNewEntity ()
    {
        return new Languages();
    }

    /**
     * @see BaseApiController::getNewEntity()
     * @return Object
     */
    public function getFormType ()
    {
        return LanguageType::class;
    }

}
