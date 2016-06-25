<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Languages;
use Doctrine\ORM\EntityRepository;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Request\ParamFetcher;

use AppBundle\Form\LanguageType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LangController extends BaseApiController
{
    /**
     *
     * @Get("/lang/")
     *
     * @param Request      $request
     * @param ParamFetcher $paramFetcher
     *
     * @return Response
     */
    public function getLangsAction (Request $request , ParamFetcher $paramFetcher)
    {
        return BaseApiController::listAction($request , $paramFetcher);
    }

    /**
     *
     * @Get("/lang/{id}")
     *
     * @param Request $request
     * @param         $id
     *
     * @return Response
     * @internal param ParamFetcher $paramFetcher
     *
     */
    public function getLangAction (Request $request , $id)
    {
        return BaseApiController::readAction($request , $id);
    }

    /**
     *
     * @Post("/lang/")
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
     *
     * @Put("/lang/{id}")
     *
     * @param Request $request
     * @param         $id
     *
     * @return Response
     */
    public function putLangAction (Request $request , $id)
    {
        return BaseApiController::updateAction($request , $id);
    }

    /**
     *
     * @Delete("/lang/{id}")
     *
     * @param Request      $request
     * @param ParamFetcher $paramFetcher
     * @param              $id
     *
     * @return Response
     */
    public function deleteLangAction (Request $request , ParamFetcher $paramFetcher , $id)
    {
        return BaseApiController::updateAction($request , $paramFetcher , $id);
    }

    /**
     * @see BaseApiController::getRepository()
     *
     * @return EntityRepository
     */
    public function getRepository ()
    {
        return $this->getDoctrine()->getManager()->getRepository('AppBundle:Languages');
    }

    /**
     * @see BaseApiController::getNewEntity()
     *
     * @return Object
     */
    public function getNewEntity ()
    {
        return new Languages();
    }

    /**
     * @see BaseApiController::getNewEntity()
     *
     * @return Object
     */
    public function getFormType ()
    {
        return LanguageType::class;
    }

}
