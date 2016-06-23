<?php

namespace AppBundle\Controller\Api;

use Doctrine\ORM\EntityRepository;

use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Delete;

use AppBundle\Entity\Lang;
use AppBundle\Form\LangType;

class LangController extends BaseApiController
{
    /**
     *
     * @Get("/lang/", name="")
     *
     * @return Response
     */
    public function getLangAction(Request $request, ParamFetcherInterface $paramFetcher) {
        return BaseApiController::listAction($request, $paramFetcher);
    }

    /**
     *
     * @Post("/lang/", name="post")
     *
     * @param Request $request
     * @return Response
     */
    public function postLangAction(Request $request)
    {
        return BaseApiController::createAction($request);
    }

    /**
     * @see BaseApiController::getRepository()
     * @return EntityRepository
     */
    public function getRepository()
    {
        return $this->getDoctrine()->getManager()->getRepository('AppBundle:Lang');
    }

    /**
     * @see BaseApiController::getNewEntity()
     * @return Object
     */
    public function getNewEntity()
    {
        return new Lang();
    }

    /**
     * @see BaseApiController::getNewEntity()
     * @return Object
     */
    public function getFormType()
    {
        return LangType::class;
    }

}
