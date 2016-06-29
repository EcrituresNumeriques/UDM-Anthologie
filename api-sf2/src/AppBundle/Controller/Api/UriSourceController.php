<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\UriSources;
use AppBundle\Form\UriSourcesType;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Request\ParamFetcher;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UriSourceController extends BaseApiController
{
    /**
     * @see BaseApiController::getParams()
     *
     * @return Object[]
     */
    public function getParams ()
    {
        return array(
            "repository"   => $this->getDoctrine()->getManager()->getRepository('AppBundle:UriSources') ,
            "entity"       => new UriSources() ,
            "entityName"   => "UriSources" ,
            "entitySetter" => "setUriSource" ,
            "entityForm"   => new UriSourcesType() ,
        );
    }

    /**
     * @ApiDoc(
     *     resource=true,
     *     description="Get a list of UriSources and related datas",
     *     requirements={
     *          {
     *              "name"="access_token",
     *              "dataType"="String",
     *              "requirement"="\d+",
     *              "description"="OAuth token is needed for security"
     *          }
     *     },
     *     filters={
     *         {"name"="offset", "dataType"="integer"},
     *         {"name"="limit", "dataType"="integer"},
     *         {"name"="deleted", "dataType"="integer", "pattern"="0|1"},
     *         {"name"="groupId", "dataType"="integer"},
     *         {"name"="userId", "dataType"="integer"},
     *         {"name"="lang", "dataType"="integer"}
     *     },
     *     statusCodes={
     *         200="Returned when successful",
     *         401="Returned when the user is not authorized to say hello"
     *     }
     * )
     *
     * @Get("/uri/source/")
     *
     * @param Request      $request
     * @param ParamFetcher $paramFetcher
     *
     * @return Response
     */
    public function getUriSourcesAction (Request $request , ParamFetcher $paramFetcher)
    {
        return BaseApiController::listAction($request , $paramFetcher);
    }

    /**
     * @ApiDoc(
     *     resource=true,
     *     description="Get an UriSource and related datas",
     *     requirements={
     *          {
     *              "name"="access_token",
     *              "dataType"="String",
     *              "requirement"="\d+",
     *              "description"="OAuth token is needed for security"
     *          },
     *          {
     *              "name"="id",
     *              "dataType"="Integer",
     *              "requirement"="\d+",
     *              "description"="keyword identifier"
     *          }
     *     },
     *     statusCodes={
     *         200="Returned when successful",
     *         204="Returned when no content",
     *         401="Returned when the user is not authorized to say hello",
     *         404="Returned when a parameter is not found"
     *     }
     * )
     *
     * @Get("/uri/source/{id}")
     *
     * @param Request $request
     * @param         $id
     *
     * @return Response
     * @internal param ParamFetcher $paramFetcher
     *
     */
    public function getUriSourceAction (Request $request , $id)
    {
        return BaseApiController::readAction($request , $id);
    }

    /**
     * @ApiDoc(
     *     description="Create a new UriSource",
     *     requirements={
     *          {
     *              "name"="id",
     *              "dataType"="Integer",
     *              "requirement"="\d+",
     *              "description"="keyword identifier"
     *          }
     *     },
     *     input="AppBundle\Form\UriSourcesType",
     *     output="AppBundle\Entity\UriSources",
     *     statusCodes={
     *         200="Returned when successful",
     *         401="Returned when the user is not authorized to say hello",
     *     }
     * )
     *
     * @Post("/uri/source/")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function postUriSourceAction (Request $request)
    {
        return BaseApiController::createAction($request);
    }

    /**
     * @ApiDoc(
     *     description="Edit an UriSource",
     *     requirements={
     *          {
     *              "name"="access_token",
     *              "dataType"="String",
     *              "requirement"="\d+",
     *              "description"="OAuth token is needed for security"
     *          },
     *          {
     *              "name"="id",
     *              "dataType"="Integer",
     *              "requirement"="\d+",
     *              "description"="keyword identifier"
     *          }
     *     },
     *     input="AppBundle\Form\UriSourcesType",
     *     output="AppBundle\Entity\UriSources",
     *     statusCodes={
     *         200="Returned when successful",
     *         401="Returned when the user is not authorized to say hello",
     *         404="Returned when a parameter is not found"
     *     }
     * )
     *
     * @Put("/uri/source/{id}")
     *
     * @param Request      $request
     * @param              $id
     *
     * @return Response
     */
    public function putUriSourceAction (Request $request , $id)
    {
        return BaseApiController::updateAction($request , $id);
    }

    /**
     * @ApiDoc(
     *     description="Edit an UriSource",
     *     requirements={
     *          {
     *              "name"="access_token",
     *              "dataType"="String",
     *              "requirement"="\d+",
     *              "description"="OAuth token is needed for security"
     *          },
     *          {
     *              "name"="id",
     *              "dataType"="Integer",
     *              "requirement"="\d+",
     *              "description"="keyword id"
     *          }
     *     },
     *     statusCodes={
     *         200="Returned when successful",
     *         401="Returned when the user is not authorized to say hello",
     *         404="Returned when a parameter is not found"
     *     }
     * )
     * @Delete("/uri/source/{id}")
     *
     * @param Request      $request
     * @param ParamFetcher $paramFetcher
     * @param              $id
     *
     * @return Response
     */
    public function deleteUriSourceAction (Request $request , ParamFetcher $paramFetcher , $id)
    {
        return BaseApiController::deleteAction($request , $paramFetcher , $id);
    }

}
