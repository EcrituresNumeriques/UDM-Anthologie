<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Motifs;
use AppBundle\Entity\MotifsTranslations;
use AppBundle\Form\MotifsTranslationsType;
use AppBundle\Form\MotifsType;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Request\ParamFetcher;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MotifsController extends BaseApiController
{
    /**
     * @see BaseApiController::getParams()
     *
     * @return Object[]
     */
    public function getParams ()
    {
        return array(
            "repository"            => $this->getDoctrine()->getManager()->getRepository('AppBundle:Motifs') ,
            "repositoryTranslation" => $this->getDoctrine()->getManager()->getRepository('AppBundle:MotifsTranslations') ,
            "entity"                => new Motifs() ,
            "entityName"            => "Motifs" ,
            "entitySetter"          => "setMotif" ,
            "entityForm"            => new MotifsType() ,
            "entityTranslation"     => new MotifsTranslations() ,
            "entityTranslationName" => "MotifsTranslations" ,
            "entityTranslationForm" => new MotifsTranslationsType() ,
        );
    }

    /**
     * @ApiDoc(
     *     resource=true,
     *     description="Get a list of motifs and related datas",
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
     * @ApiDoc(
     *     resource=true,
     *     description="Get a Motif and related datas",
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
     *              "description"="motif identifier"
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
     * @ApiDoc(
     *     description="Create a new Motif",
     *     requirements={
     *          {
     *              "name"="id",
     *              "dataType"="Integer",
     *              "requirement"="\d+",
     *              "description"="motif identifier"
     *          }
     *     },
     *     input="AppBundle\Form\MotifsType",
     *     output="AppBundle\Entity\Motifs",
     *     statusCodes={
     *         200="Returned when successful",
     *         401="Returned when the user is not authorized to say hello",
     *     }
     * )
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
     * @ApiDoc(
     *     description="Edit a Motif",
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
     *              "description"="motif identifier"
     *          }
     *     },
     *     input="AppBundle\Form\MotifsType",
     *     output="AppBundle\Entity\Motifs",
     *     statusCodes={
     *         200="Returned when successful",
     *         401="Returned when the user is not authorized to say hello",
     *         404="Returned when a parameter is not found"
     *     }
     * )
     *
     * @Put("/motif/{id}")
     *
     * @param Request      $request
     * @param              $id
     *
     * @return Response
     */
    public function putMotifAction (Request $request , $id)
    {
        return BaseApiController::updateAction($request , $id);
    }

    /**
     * @ApiDoc(
     *     description="Edit a Motif",
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
     *              "description"="motif id"
     *          }
     *     },
     *     statusCodes={
     *         200="Returned when successful",
     *         401="Returned when the user is not authorized to say hello",
     *         404="Returned when a parameter is not found"
     *     }
     * )
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
        return BaseApiController::deleteAction($request , $paramFetcher , $id);
    }

    /**
     * @ApiDoc(
     *     description="Create a new Motif translation",
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
     *              "description"="motif id"
     *          }
     *     },
     *     input="AppBundle\Form\MotifsTranslationsType",
     *     output="AppBundle\Entity\MotifsTranslations",
     *     statusCodes={
     *         200="Returned when successful",
     *         400="Returned when a parameter is not found",
     *         401="Returned when the user is not authorized to say hello"
     *     }
     * )
     *
     * @Post("/motif/{id}/translation/")
     *
     * @param Request $request
     * @param         $id
     *
     * @return Response
     */
    public function postMotifTranslationAction (Request $request , $id)
    {
        return BaseApiController::createTranslationAction($request , $id);
    }

    /**
     * @ApiDoc(
     *     description="Edit a Motif translation",
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
     *              "description"="motif id"
     *          },
     *          {
     *              "name"="id",
     *              "dataType"="Integer",
     *              "requirement"="\d+",
     *              "description"="motif translation id"
     *          }
     *     },
     *     input="AppBundle\Form\MotifsTranslationsType",
     *     output="AppBundle\Entity\MotifsTranslations",
     *     statusCodes={
     *         200="Returned when successful",
     *         401="Returned when the user is not authorized to say hello",
     *         403="Returned when the user is not modify datas",
     *         404="Returned when a parameter is not found"
     *     }
     * )
     *
     * @Put("/motif/{id}/translation/{idTranslation}")
     *
     * @param Request $request
     * @param         $id
     * @param         $idTranslation
     *
     * @return Response
     */
    public function putMotifTranslationAction (Request $request , $id , $idTranslation)
    {
        return BaseApiController::updateTranslationAction($request , $idTranslation);
    }

    /**
     * @ApiDoc(
     *     description="Delete a Motif translation",
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
     *              "description"="motif translation id"
     *          },
     *          {
     *              "name"="id",
     *              "dataType"="Integer",
     *              "requirement"="\d+",
     *              "description"="motif translation id"
     *          }
     *     },
     *     statusCodes={
     *         200="Returned when successful",
     *         401="Returned when the user is not authorized to say hello",
     *         404="Returned when a parameter is not found"
     *     }
     * )
     * @Delete("/motif/{id}/translation/{idTranslation}")
     *
     * @param Request      $request
     * @param ParamFetcher $paramFetcher
     * @param              $id
     * @param              $idTranslation
     *
     * @return Response
     */
    public function deleteMotifTranslationAction (Request $request , ParamFetcher $paramFetcher , $id , $idTranslation)
    {
        return BaseApiController::deleteTranslationAction($request , $paramFetcher , $idTranslation);
    }

}
