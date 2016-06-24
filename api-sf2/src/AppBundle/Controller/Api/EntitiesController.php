<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Entities;
use AppBundle\Entity\EntitiesTranslations;
use AppBundle\Form\EntitiesType;
use Doctrine\ORM\EntityRepository;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EntitiesController extends BaseApiController
{
    /**
     *
     * @Get("/entity/")
     *
     * @param Request      $request
     * @param ParamFetcher $paramFetcher
     *
     * @return Response
     */
    public function getEntitiesAction (Request $request , ParamFetcher $paramFetcher)
    {
        return BaseApiController::listAction($request , $paramFetcher);
    }

    /**
     *
     * @Get("/entity/{id}")
     *
     * @param Request $request
     * @param         $id
     *
     * @return Response
     * @internal param ParamFetcher $paramFetcher
     *
     */
    public function getEntityAction (Request $request , $id)
    {
        return BaseApiController::readAction($request , $id);
    }

    /**
     *
     * @Post("/entity/")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function postEntityAction (Request $request)
    {
        return BaseApiController::createAction($request);
    }

    /**
     *
     * @Put("/entity/{id}")
     *
     * @param Request $request
     * @param         $id
     *
     * @return Response
     */
    public function putEntityAction (Request $request , $id)
    {
        return BaseApiController::updateAction($request , $id);
    }

    /**
     *
     * @Delete("/entity/{id}")
     *
     * @param Request      $request
     * @param ParamFetcher $paramFetcher
     * @param              $id
     *
     * @return Response
     */
    public function deleteEntityAction (Request $request , ParamFetcher $paramFetcher , $id)
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
        return $this->getDoctrine()->getManager()->getRepository('AppBundle:Entities');
    }

    /**
     * @see BaseApiController::getNewEntity()
     *
     * @return Object
     */
    public function getNewEntity ()
    {
        return new Entities();
    }

    /**
     * @see BaseApiController::getNewEntity()
     *
     * @return Object
     */
    public function getEntityTranslation ()
    {
        return new EntitiesTranslations();
    }

    /**
     * @see BaseApiController::getNewEntity()
     *
     * @return Object
     */
    public function getFormType ()
    {
        return EntitiesType::class;
    }

}
