<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Books;
use AppBundle\Entity\BooksTranslations;
use AppBundle\Entity\Cities;
use AppBundle\Entity\CitiesTranslations;
use AppBundle\Form\BooksType;
use AppBundle\Form\CitiesType;
use Doctrine\ORM\EntityRepository;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CitiesController extends BaseApiController
{
    /**
     *
     * @Get("/city/")
     *
     * @param Request      $request
     * @param ParamFetcher $paramFetcher
     *
     * @return Response
     */
    public function getCitiesAction (Request $request , ParamFetcher $paramFetcher)
    {
        return BaseApiController::listAction($request , $paramFetcher);
    }

    /**
     *
     * @Get("/city/{id}")
     *
     * @param Request $request
     * @param         $id
     *
     * @return Response
     * @internal param ParamFetcher $paramFetcher
     *
     */
    public function getCityAction (Request $request , $id)
    {
        return BaseApiController::readAction($request , $id);
    }

    /**
     *
     * @Post("/city/")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function postCityAction (Request $request)
    {
        return BaseApiController::createAction($request);
    }

    /**
     *
     * @Put("/city/{id}")
     *
     * @param Request $request
     * @param         $id
     *
     * @return Response
     */
    public function putCityAction (Request $request , $id)
    {
        return BaseApiController::updateAction($request , $id);
    }

    /**
     *
     * @Delete("/city/{id}")
     *
     * @param Request      $request
     * @param ParamFetcher $paramFetcher
     * @param              $id
     *
     * @return Response
     */
    public function deleteCityAction (Request $request , ParamFetcher $paramFetcher , $id)
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
        return $this->getDoctrine()->getManager()->getRepository('AppBundle:Cities');
    }

    /**
     * @see BaseApiController::getNewEntity()
     *
     * @return Object
     */
    public function getNewEntity ()
    {
        return new Cities();
    }

    /**
     * @see BaseApiController::getNewEntity()
     *
     * @return Object
     */
    public function getEntityTranslation ()
    {
        return new CitiesTranslations();
    }

    /**
     * @see BaseApiController::getNewEntity()
     *
     * @return Object
     */
    public function getFormType ()
    {
        return CitiesType::class;
    }

}
