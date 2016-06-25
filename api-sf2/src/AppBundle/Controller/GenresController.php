<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Genres;
use AppBundle\Entity\GenresTranslations;
use AppBundle\Form\GenresType;
use Doctrine\ORM\EntityRepository;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GenresController extends BaseApiController
{
    /**
     *
     * @Get("/genre/")
     *
     * @param Request      $request
     * @param ParamFetcher $paramFetcher
     *
     * @return Response
     */
    public function getGenresAction (Request $request , ParamFetcher $paramFetcher)
    {
        return BaseApiController::listAction($request , $paramFetcher);
    }

    /**
     *
     * @Get("/genre/{id}")
     *
     * @param Request $request
     * @param         $id
     *
     * @return Response
     * @internal param ParamFetcher $paramFetcher
     *
     */
    public function getGenreAction (Request $request , $id)
    {
        return BaseApiController::readAction($request , $id);
    }

    /**
     *
     * @Post("/genre/")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function postGenreAction (Request $request)
    {
        return BaseApiController::createAction($request);
    }

    /**
     *
     * @Put("/genre/{id}")
     *
     * @param Request $request
     * @param         $id
     *
     * @return Response
     */
    public function putGenreAction (Request $request , $id)
    {
        return BaseApiController::updateAction($request , $id);
    }

    /**
     *
     * @Delete("/genre/{id}")
     *
     * @param Request      $request
     * @param ParamFetcher $paramFetcher
     * @param              $id
     *
     * @return Response
     */
    public function deleteGenreAction (Request $request , ParamFetcher $paramFetcher , $id)
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
        return $this->getDoctrine()->getManager()->getRepository('AppBundle:Genres');
    }

    /**
     * @see BaseApiController::getNewEntity()
     *
     * @return Object
     */
    public function getNewEntity ()
    {
        return new Genres();
    }

    /**
     * @see BaseApiController::getNewEntity()
     *
     * @return Object
     */
    public function getEntityTranslation ()
    {
        return new GenresTranslations();
    }

    /**
     * @see BaseApiController::getNewEntity()
     *
     * @return Object
     */
    public function getFormType ()
    {
        return GenresType::class;
    }

}
