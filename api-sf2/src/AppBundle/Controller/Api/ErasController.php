<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Eras;
use AppBundle\Entity\ErasTranslations;
use AppBundle\Form\ErasTranslationsType;
use AppBundle\Form\ErasType;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Request\ParamFetcher;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ErasController extends BaseApiController
{
    /**
     * @see BaseApiController::getParams()
     *
     * @return Object[]
     */
    public function getParams ()
    {
        return array(
            "repository"            => $this->getDoctrine()->getManager()->getRepository('AppBundle:Eras') ,
            "repositoryTranslation" => $this->getDoctrine()->getManager()->getRepository('AppBundle:ErasTranslations') ,
            "entity"                => new Eras() ,
            "entityName"            => "Eras" ,
            "entitySetter"          => "setEra" ,
            "entityForm"            => new ErasType() ,
            "entityTranslation"     => new ErasTranslations() ,
            "entityTranslationName" => "ErasTranslations" ,
            "entityTranslationForm" => new ErasTranslationsType() ,
        );
    }

    /**
     * @ApiDoc(
     *     resource=true,
     *     description="Get a list of Eras and related datas",
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
     * @Get("/era/")
     *
     * @param Request      $request
     * @param ParamFetcher $paramFetcher
     *
     * @return Response
     */
    public function getErasAction (Request $request , ParamFetcher $paramFetcher)
    {
        return BaseApiController::listAction($request , $paramFetcher);
    }

    /**
     * @ApiDoc(
     *     resource=true,
     *     description="Get an Era and related datas",
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
     *              "description"="era identifier"
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
     * @Get("/era/{id}")
     *
     * @param Request $request
     * @param         $id
     *
     * @return Response
     * @internal param ParamFetcher $paramFetcher
     *
     */
    public function getEraAction (Request $request , $id)
    {
        return BaseApiController::readAction($request , $id);
    }

    /**
     * @ApiDoc(
     *     description="Create a new Era",
     *     requirements={
     *          {
     *              "name"="id",
     *              "dataType"="Integer",
     *              "requirement"="\d+",
     *              "description"="era identifier"
     *          }
     *     },
     *     input="AppBundle\Form\ErasType",
     *     output="AppBundle\Entity\Eras",
     *     statusCodes={
     *         200="Returned when successful",
     *         401="Returned when the user is not authorized to say hello",
     *     }
     * )
     *
     * @Post("/era/")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function postEraAction (Request $request)
    {
        return BaseApiController::createAction($request);
    }

    /**
     * @ApiDoc(
     *     description="Edit an Era",
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
     *              "description"="era identifier"
     *          }
     *     },
     *     input="AppBundle\Form\ErasType",
     *     output="AppBundle\Entity\Eras",
     *     statusCodes={
     *         200="Returned when successful",
     *         401="Returned when the user is not authorized to say hello",
     *         404="Returned when a parameter is not found"
     *     }
     * )
     *
     * @Put("/era/{id}")
     *
     * @param Request      $request
     * @param              $id
     *
     * @return Response
     */
    public function putEraAction (Request $request , $id)
    {
        return BaseApiController::updateAction($request , $id);
    }

    /**
     * @ApiDoc(
     *     description="Edit an Era",
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
     *              "description"="era id"
     *          }
     *     },
     *     statusCodes={
     *         200="Returned when successful",
     *         401="Returned when the user is not authorized to say hello",
     *         404="Returned when a parameter is not found"
     *     }
     * )
     * @Delete("/era/{id}")
     *
     * @param Request      $request
     * @param ParamFetcher $paramFetcher
     * @param              $id
     *
     * @return Response
     */
    public function deleteEraAction (Request $request , ParamFetcher $paramFetcher , $id)
    {
        return BaseApiController::deleteAction($request , $paramFetcher , $id);
    }

    /**
     * @ApiDoc(
     *     description="Create a new Era translation",
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
     *              "description"="era id"
     *          }
     *     },
     *     input="AppBundle\Form\ErasTranslationsType",
     *     output="AppBundle\Entity\ErasTranslations",
     *     statusCodes={
     *         200="Returned when successful",
     *         400="Returned when a parameter is not found",
     *         401="Returned when the user is not authorized to say hello"
     *     }
     * )
     *
     * @Post("/era/{id}/translation/")
     *
     * @param Request $request
     * @param         $id
     *
     * @return Response
     */
    public function postEraTranslationAction (Request $request , $id)
    {
        return BaseApiController::createTranslationAction($request , $id);
    }

    /**
     * @ApiDoc(
     *     description="Edit an Era translation",
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
     *              "description"="era id"
     *          },
     *          {
     *              "name"="id",
     *              "dataType"="Integer",
     *              "requirement"="\d+",
     *              "description"="era translation id"
     *          }
     *     },
     *     input="AppBundle\Form\ErasTranslationsType",
     *     output="AppBundle\Entity\ErasTranslations",
     *     statusCodes={
     *         200="Returned when successful",
     *         401="Returned when the user is not authorized to say hello",
     *         403="Returned when the user is not modify datas",
     *         404="Returned when a parameter is not found"
     *     }
     * )
     *
     * @Put("/era/{id}/translation/{idTranslation}")
     *
     * @param Request $request
     * @param         $id
     * @param         $idTranslation
     *
     * @return Response
     */
    public function putEraTranslationAction (Request $request , $id , $idTranslation)
    {
        return BaseApiController::updateTranslationAction($request , $idTranslation);
    }

    /**
     * @ApiDoc(
     *     description="Delete an Era translation",
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
     *              "description"="era translation id"
     *          },
     *          {
     *              "name"="id",
     *              "dataType"="Integer",
     *              "requirement"="\d+",
     *              "description"="era translation id"
     *          }
     *     },
     *     statusCodes={
     *         200="Returned when successful",
     *         401="Returned when the user is not authorized to say hello",
     *         404="Returned when a parameter is not found"
     *     }
     * )
     * @Delete("/era/{id}/translation/{idTranslation}")
     *
     * @param Request      $request
     * @param ParamFetcher $paramFetcher
     * @param              $id
     * @param              $idTranslation
     *
     * @return Response
     */
    public function deleteEraTranslationAction (Request $request , ParamFetcher $paramFetcher , $id , $idTranslation)
    {
        return BaseApiController::deleteTranslationAction($request , $paramFetcher , $idTranslation);
    }

}
