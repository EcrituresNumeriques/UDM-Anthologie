<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Entities;
use AppBundle\Entity\EntitiesTranslations;
use AppBundle\Form\EntitiesFullType;
use AppBundle\Form\EntitiesTranslationsType;
use AppBundle\Form\EntitiesType;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Request\ParamFetcher;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EntitiesController extends BaseApiController
{
    /**
     * @see BaseApiController::getParams()
     *
     * @return Object[]
     */
    public function getParams ()
    {
        return array(
            "repository"            => $this->getDoctrine()->getManager()->getRepository('AppBundle:Entities') ,
            "repositoryTranslation" => $this->getDoctrine()->getManager()->getRepository('AppBundle:EntitiesTranslations') ,
            "entity"                => new Entities() ,
            "entityName"            => "Entities" ,
            "entitySetter"          => "setEntity" ,
            "entityForm"            => new EntitiesType() ,
            "entityTranslation"     => new EntitiesTranslations() ,
            "entityTranslationName" => "EntitiesTranslations" ,
            "entityTranslationForm" => new EntitiesTranslationsType() ,
        );
    }

    /**
     * @ApiDoc(
     *     resource=true,
     *     description="Get a list of entities and related datas",
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
     * @ApiDoc(
     *     resource=true,
     *     description="Get an entity and related datas",
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
     *              "description"="entity identifier"
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
     * @ApiDoc(
     *     description="Create a new Entity",
     *     requirements={
     *          {
     *              "name"="id",
     *              "dataType"="Integer",
     *              "requirement"="\d+",
     *              "description"="entity identifier"
     *          }
     *     },
     *     input="AppBundle\Form\EntitiesType",
     *     output="AppBundle\Entity\Entities",
     *     statusCodes={
     *         200="Returned when successful",
     *         401="Returned when the user is not authorized to say hello",
     *     }
     * )
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
     * @ApiDoc(
     *     description="Create a new Entity with all her relations",
     *     requirements={
     *          {
     *              "name"="id",
     *              "dataType"="Integer",
     *              "requirement"="\d+",
     *              "description"="entity identifier"
     *          }
     *     },
     *     input="AppBundle\Form\EntitiesFullType",
     *     output="AppBundle\Entity\Entities",
     *     statusCodes={
     *         200="Returned when successful",
     *         401="Returned when the user is not authorized to say hello",
     *     }
     * )
     *
     * @Post("/entityRelations/")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function postEntityRelationsAction (Request $request)
    {
        $entity     = $this->getParams()["entity"];
        $entityForm = new EntitiesFullType();
        $em         = $this->getDoctrine()->getManager();
        $form       = $this->createForm($entityForm , $entity , array("method" => $request->getMethod()));
        $form->handleRequest($request);
        $view = $this->view($form , 404);
        if ($form->isValid()) {
            $user = $this->get('security.token_storage')
                ->getToken()
                ->getUser();
            $entity->setUser($user);
            $em->persist($entity);
            $em->flush();
            $view = $this->view($entity , 200);
        }

        return $this->handleView($view);
    }

    /**
     * @ApiDoc(
     *     description="Edit an Entity",
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
     *              "description"="entity identifier"
     *          }
     *     },
     *     input="AppBundle\Form\EntitiesType",
     *     output="AppBundle\Entity\Entities",
     *     statusCodes={
     *         200="Returned when successful",
     *         401="Returned when the user is not authorized to say hello",
     *         404="Returned when a parameter is not found"
     *     }
     * )
     *
     * @Put("/entity/{id}")
     *
     * @param Request      $request
     * @param              $id
     *
     * @return Response
     */
    public function putEntityAction (Request $request , $id)
    {
        return BaseApiController::updateAction($request , $id);
    }

    /**
     * @ApiDoc(
     *     description="Edit an Entity",
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
     *              "description"="entity id"
     *          }
     *     },
     *     statusCodes={
     *         200="Returned when successful",
     *         401="Returned when the user is not authorized to say hello",
     *         404="Returned when a parameter is not found"
     *     }
     * )
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
        return BaseApiController::deleteAction($request , $paramFetcher , $id);
    }

    /**
     * @ApiDoc(
     *     description="Create a new Entity translation",
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
     *              "description"="entity id"
     *          }
     *     },
     *     input="AppBundle\Form\EntitiesTranslationsType",
     *     output="AppBundle\Entity\EntitiesTranslations",
     *     statusCodes={
     *         200="Returned when successful",
     *         400="Returned when a parameter is not found",
     *         401="Returned when the user is not authorized to say hello"
     *     }
     * )
     *
     * @Post("/entity/{id}/translation/")
     *
     * @param Request $request
     * @param         $id
     *
     * @return Response
     */
    public function postEntityTranslationAction (Request $request , $id)
    {
        return BaseApiController::createTranslationAction($request , $id);
    }

    /**
     * @ApiDoc(
     *     description="Edit an Entity translation",
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
     *              "description"="entity id"
     *          },
     *          {
     *              "name"="id",
     *              "dataType"="Integer",
     *              "requirement"="\d+",
     *              "description"="entity translation id"
     *          }
     *     },
     *     input="AppBundle\Form\EntitiesTranslationsType",
     *     output="AppBundle\Entity\EntitiesTranslations",
     *     statusCodes={
     *         200="Returned when successful",
     *         401="Returned when the user is not authorized to say hello",
     *         403="Returned when the user is not modify datas",
     *         404="Returned when a parameter is not found"
     *     }
     * )
     *
     * @Put("/entity/{id}/translation/{idTranslation}")
     *
     * @param Request $request
     * @param         $id
     * @param         $idTranslation
     *
     * @return Response
     */
    public function putEntityTranslationAction (Request $request , $id , $idTranslation)
    {
        return BaseApiController::updateTranslationAction($request , $idTranslation);
    }

    /**
     * @ApiDoc(
     *     description="Delete an Entity translation",
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
     *              "description"="entity translation id"
     *          },
     *          {
     *              "name"="id",
     *              "dataType"="Integer",
     *              "requirement"="\d+",
     *              "description"="entity translation id"
     *          }
     *     },
     *     statusCodes={
     *         200="Returned when successful",
     *         401="Returned when the user is not authorized to say hello",
     *         404="Returned when a parameter is not found"
     *     }
     * )
     * @Delete("/entity/{id}/translation/{idTranslation}")
     *
     * @param Request      $request
     * @param ParamFetcher $paramFetcher
     * @param              $id
     * @param              $idTranslation
     *
     * @return Response
     */
    public function deleteEntityTranslationAction (Request $request , ParamFetcher $paramFetcher , $id , $idTranslation)
    {
        return BaseApiController::deleteTranslationAction($request , $paramFetcher , $idTranslation);
    }

}
