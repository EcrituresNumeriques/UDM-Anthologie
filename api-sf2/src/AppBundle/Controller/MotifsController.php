<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Motifs;
use AppBundle\Entity\MotifsTranslations;
use AppBundle\Form\MotifsType;
use Doctrine\ORM\EntityRepository;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MotifsController extends BaseApiController
{
    /**
     *
     * @Get("/motif/")
     *
     * @param Request      $request
     * @param ParamFetcher $paramFetcher
     *
     * @return Response
     */
    public function getMotifsAction (Request $request , ParamFetcher $paramFetcher)
    {
        return BaseApiController::listAction($request , $paramFetcher);
    }

    /**
     *
     * @Get("/motif/{id}")
     *
     * @param Request $request
     * @param         $id
     *
     * @return Response
     * @internal param ParamFetcher $paramFetcher
     *
     */
    public function getMotifAction (Request $request , $id)
    {
        return BaseApiController::readAction($request , $id);
    }

    /**
     *
     * @Post("/motif/")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function postMotifAction (Request $request)
    {
        return BaseApiController::createAction($request);
    }

    /**
     *
     * @Put("/motif/{id}")
     *
     * @param Request $request
     * @param         $id
     *
     * @return Response
     */
    public function putMotifAction (Request $request , $id)
    {
        return BaseApiController::updateAction($request , $id);
    }

    /**
     *
     * @Delete("/motif/{id}")
     *
     * @param Request      $request
     * @param ParamFetcher $paramFetcher
     * @param              $id
     *
     * @return Response
     */
    public function deleteMotifAction (Request $request , ParamFetcher $paramFetcher , $id)
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
        return $this->getDoctrine()->getManager()->getRepository('AppBundle:Motifs');
    }

    /**
     * @see BaseApiController::getNewEntity()
     *
     * @return Object
     */
    public function getNewEntity ()
    {
        return new Motifs();
    }

    /**
     * @see BaseApiController::getNewEntity()
     *
     * @return Object
     */
    public function getEntityTranslation ()
    {
        return new MotifsTranslations();
    }

    /**
     * @see BaseApiController::getNewEntity()
     *
     * @return Object
     */
    public function getFormType ()
    {
        return MotifsType::class;
    }

}
