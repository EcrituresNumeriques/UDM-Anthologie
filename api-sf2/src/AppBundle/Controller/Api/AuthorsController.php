<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Authors;
use AppBundle\Entity\AuthorsTranslations;
use AppBundle\Form\AuthorsTranslationsType;
use AppBundle\Form\AuthorsType;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Request\ParamFetcher;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorsController extends BaseApiController
{
    /**
     * @see BaseApiController::getParams()
     *
     * @return Object[]
     */
    public function getParams ()
    {
        return array(
            "repository"            => $this->getDoctrine()->getManager()->getRepository('AppBundle:Authors') ,
            "repositoryTranslation" => $this->getDoctrine()->getManager()->getRepository('AppBundle:AuthorsTranslations') ,
            "entity"                => new Authors() ,
            "entityName"            => "Authors" ,
            "entitySetter"          => "setAuthor" ,
            "entityForm"            => new AuthorsType() ,
            "entityTranslation"     => new AuthorsTranslations() ,
            "entityTranslationName" => "AuthorsTranslations" ,
            "entityTranslationForm" => new AuthorsTranslationsType() ,
        );
    }

    /**
     * @ApiDoc(
     *     resource=true,
     *     description="Get a list of authors and related datas",
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
     * @Get("/author/")
     *
     * @param Request      $request
     * @param ParamFetcher $paramFetcher
     *
     * @return Response
     */
    public function getAuthorsAction (Request $request , ParamFetcher $paramFetcher)
    {
        return BaseApiController::listAction($request , $paramFetcher);
    }

    /**
     * @ApiDoc(
     *     resource=true,
     *     description="Get an author and related datas",
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
     *              "description"="author identifier"
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
     * @Get("/author/{id}")
     *
     * @param Request $request
     * @param         $id
     *
     * @return Response
     * @internal param ParamFetcher $paramFetcher
     *
     */
    public function getAuthorAction (Request $request , $id)
    {
        return BaseApiController::readAction($request , $id);
    }

    /**
     * @ApiDoc(
     *     description="Create a new Author",
     *     requirements={
     *          {
     *              "name"="id",
     *              "dataType"="Integer",
     *              "requirement"="\d+",
     *              "description"="author identifier"
     *          }
     *     },
     *     input="AppBundle\Form\AuthorsType",
     *     output="AppBundle\Entity\Authors",
     *     statusCodes={
     *         200="Returned when successful",
     *         401="Returned when the user is not authorized to say hello",
     *     }
     * )
     *
     * @Post("/author/")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function postAuthorAction (Request $request)
    {
        return BaseApiController::createAction($request);
    }

    /**
     * @ApiDoc(
     *     description="Edit an Author",
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
     *              "description"="author identifier"
     *          }
     *     },
     *     input="AppBundle\Form\AuthorsType",
     *     output="AppBundle\Entity\Authors",
     *     statusCodes={
     *         200="Returned when successful",
     *         401="Returned when the user is not authorized to say hello",
     *         404="Returned when a parameter is not found"
     *     }
     * )
     *
     * @Put("/author/{id}")
     *
     * @param Request      $request
     * @param              $id
     *
     * @return Response
     */
    public function putAuthorAction (Request $request , $id)
    {
        return BaseApiController::updateAction($request , $id);
    }

    /**
     * @ApiDoc(
     *     description="Edit an Author",
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
     *              "description"="author id"
     *          }
     *     },
     *     statusCodes={
     *         200="Returned when successful",
     *         401="Returned when the user is not authorized to say hello",
     *         404="Returned when a parameter is not found"
     *     }
     * )
     * @Delete("/author/{id}")
     *
     * @param Request      $request
     * @param ParamFetcher $paramFetcher
     * @param              $id
     *
     * @return Response
     */
    public function deleteAuthorAction (Request $request , ParamFetcher $paramFetcher , $id)
    {
        return BaseApiController::deleteAction($request , $paramFetcher , $id);
    }

    /**
     * @ApiDoc(
     *     description="Create a new Author translation",
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
     *              "description"="author id"
     *          }
     *     },
     *     input="AppBundle\Form\AuthorsTranslationsType",
     *     output="AppBundle\Entity\AuthorsTranslations",
     *     statusCodes={
     *         200="Returned when successful",
     *         400="Returned when a parameter is not found",
     *         401="Returned when the user is not authorized to say hello"
     *     }
     * )
     *
     * @Post("/author/{id}/translation/")
     *
     * @param Request $request
     * @param         $id
     *
     * @return Response
     */
    public function postAuthorTranslationAction (Request $request , $id)
    {
        return BaseApiController::createTranslationAction($request , $id);
    }

    /**
     * @ApiDoc(
     *     description="Edit an Author translation",
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
     *              "description"="author id"
     *          },
     *          {
     *              "name"="id",
     *              "dataType"="Integer",
     *              "requirement"="\d+",
     *              "description"="author translation id"
     *          }
     *     },
     *     input="AppBundle\Form\AuthorsTranslationsType",
     *     output="AppBundle\Entity\AuthorsTranslations",
     *     statusCodes={
     *         200="Returned when successful",
     *         401="Returned when the user is not authorized to say hello",
     *         403="Returned when the user is not modify datas",
     *         404="Returned when a parameter is not found"
     *     }
     * )
     *
     * @Put("/author/{id}/translation/{idTranslation}")
     *
     * @param Request $request
     * @param         $id
     * @param         $idTranslation
     *
     * @return Response
     */
    public function putAuthorTranslationAction (Request $request , $id , $idTranslation)
    {
        return BaseApiController::updateTranslationAction($request , $idTranslation);
    }

    /**
     * @ApiDoc(
     *     description="Delete an Author translation",
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
     *              "description"="author translation id"
     *          },
     *          {
     *              "name"="id",
     *              "dataType"="Integer",
     *              "requirement"="\d+",
     *              "description"="author translation id"
     *          }
     *     },
     *     statusCodes={
     *         200="Returned when successful",
     *         401="Returned when the user is not authorized to say hello",
     *         404="Returned when a parameter is not found"
     *     }
     * )
     * @Delete("/author/{id}/translation/{idTranslation}")
     *
     * @param Request      $request
     * @param ParamFetcher $paramFetcher
     * @param              $id
     * @param              $idTranslation
     *
     * @return Response
     */
    public function deleteAuthorTranslationAction (Request $request , ParamFetcher $paramFetcher , $id , $idTranslation)
    {
        return BaseApiController::deleteTranslationAction($request , $paramFetcher , $idTranslation);
    }

}
