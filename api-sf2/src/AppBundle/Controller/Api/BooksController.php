<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Books;
use AppBundle\Entity\BooksTranslations;
use AppBundle\Form\BooksTranslationsType;
use AppBundle\Form\BooksType;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Request\ParamFetcher;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BooksController extends BaseApiController
{
    /**
     * @see BaseApiController::getParams()
     *
     * @return Object[]
     */
    public function getParams ()
    {
        return array(
            "repository"            => $this->getDoctrine()->getManager()->getRepository('AppBundle:Books') ,
            "repositoryTranslation" => $this->getDoctrine()->getManager()->getRepository('AppBundle:BooksTranslations') ,
            "entity"                => new Books() ,
            "entityName"            => "Books" ,
            "entitySetter"          => "setBook" ,
            "entityForm"            => new BooksType() ,
            "entityTranslation"     => new BooksTranslations() ,
            "entityTranslationName" => "BooksTranslations" ,
            "entityTranslationForm" => new BooksTranslationsType() ,
        );
    }

    /**
     * @ApiDoc(
     *     resource=true,
     *     description="Get a list of books and related datas",
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
     * @Get("/book/")
     *
     * @param Request      $request
     * @param ParamFetcher $paramFetcher
     *
     * @return Response
     */
    public function getBooksAction (Request $request , ParamFetcher $paramFetcher)
    {
        return BaseApiController::listAction($request , $paramFetcher);
    }

    /**
     * @ApiDoc(
     *     resource=true,
     *     description="Get a Book and related datas",
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
     *              "description"="book identifier"
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
     * @Get("/book/{id}")
     *
     * @param Request $request
     * @param         $id
     *
     * @return Response
     * @internal param ParamFetcher $paramFetcher
     *
     */
    public function getBookAction (Request $request , $id)
    {
        return BaseApiController::readAction($request , $id);
    }

    /**
     * @ApiDoc(
     *     description="Create a new Book",
     *     requirements={
     *          {
     *              "name"="id",
     *              "dataType"="Integer",
     *              "requirement"="\d+",
     *              "description"="book identifier"
     *          }
     *     },
     *     input="AppBundle\Form\BooksType",
     *     output="AppBundle\Entity\Books",
     *     statusCodes={
     *         200="Returned when successful",
     *         401="Returned when the user is not authorized to say hello",
     *     }
     * )
     *
     * @Post("/book/")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function postBookAction (Request $request)
    {
        return BaseApiController::createAction($request);
    }

    /**
     * @ApiDoc(
     *     description="Edit a Book",
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
     *              "description"="book identifier"
     *          }
     *     },
     *     input="AppBundle\Form\BooksType",
     *     output="AppBundle\Entity\Books",
     *     statusCodes={
     *         200="Returned when successful",
     *         401="Returned when the user is not authorized to say hello",
     *         404="Returned when a parameter is not found"
     *     }
     * )
     *
     * @Put("/book/{id}")
     *
     * @param Request      $request
     * @param              $id
     *
     * @return Response
     */
    public function putBookAction (Request $request , $id)
    {
        return BaseApiController::updateAction($request , $id);
    }

    /**
     * @ApiDoc(
     *     description="Edit a Book",
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
     *              "description"="book id"
     *          }
     *     },
     *     statusCodes={
     *         200="Returned when successful",
     *         401="Returned when the user is not authorized to say hello",
     *         404="Returned when a parameter is not found"
     *     }
     * )
     * @Delete("/book/{id}")
     *
     * @param Request      $request
     * @param ParamFetcher $paramFetcher
     * @param              $id
     *
     * @return Response
     */
    public function deleteBookAction (Request $request , ParamFetcher $paramFetcher , $id)
    {
        return BaseApiController::deleteAction($request , $paramFetcher , $id);
    }

    /**
     * @ApiDoc(
     *     description="Create a new Book translation",
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
     *              "description"="book id"
     *          }
     *     },
     *     input="AppBundle\Form\BooksTranslationsType",
     *     output="AppBundle\Entity\BooksTranslations",
     *     statusCodes={
     *         200="Returned when successful",
     *         400="Returned when a parameter is not found",
     *         401="Returned when the user is not authorized to say hello"
     *     }
     * )
     *
     * @Post("/book/{id}/translation/")
     *
     * @param Request $request
     * @param         $id
     *
     * @return Response
     */
    public function postBookTranslationAction (Request $request , $id)
    {
        return BaseApiController::createTranslationAction($request , $id);
    }

    /**
     * @ApiDoc(
     *     description="Edit a Book translation",
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
     *              "description"="book id"
     *          },
     *          {
     *              "name"="id",
     *              "dataType"="Integer",
     *              "requirement"="\d+",
     *              "description"="book translation id"
     *          }
     *     },
     *     input="AppBundle\Form\BooksTranslationsType",
     *     output="AppBundle\Entity\BooksTranslations",
     *     statusCodes={
     *         200="Returned when successful",
     *         401="Returned when the user is not authorized to say hello",
     *         403="Returned when the user is not modify datas",
     *         404="Returned when a parameter is not found"
     *     }
     * )
     *
     * @Put("/book/{id}/translation/{idTranslation}")
     *
     * @param Request $request
     * @param         $id
     * @param         $idTranslation
     *
     * @return Response
     */
    public function putBookTranslationAction (Request $request , $id , $idTranslation)
    {
        return BaseApiController::updateTranslationAction($request , $idTranslation);
    }

    /**
     * @ApiDoc(
     *     description="Delete a Book translation",
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
     *              "description"="book translation id"
     *          },
     *          {
     *              "name"="id",
     *              "dataType"="Integer",
     *              "requirement"="\d+",
     *              "description"="book translation id"
     *          }
     *     },
     *     statusCodes={
     *         200="Returned when successful",
     *         401="Returned when the user is not authorized to say hello",
     *         404="Returned when a parameter is not found"
     *     }
     * )
     * @Delete("/book/{id}/translation/{idTranslation}")
     *
     * @param Request      $request
     * @param ParamFetcher $paramFetcher
     * @param              $id
     * @param              $idTranslation
     *
     * @return Response
     */
    public function deleteBookTranslationAction (Request $request , ParamFetcher $paramFetcher , $id , $idTranslation)
    {
        return BaseApiController::deleteTranslationAction($request , $paramFetcher , $idTranslation);
    }

}
