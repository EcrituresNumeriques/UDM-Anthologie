<?php

namespace AppBundle\Controller\Api;

use Doctrine\ORM\EntityRepository;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseApiController extends FOSRestController
{

    /**
     * Base create action.
     *
     * @param Request $request
     *
     * @return Response
     */
    protected function createAction (Request $request)
    {
        $entity = $this->getNewEntity();
        $em     = $this->getDoctrine()->getManager();
        //exit(\Doctrine\Common\Util\Debug::dump($this->getFormType()));
        $form   = $this->createForm($this->getFormType() , $entity , array("method" => $request->getMethod()));

        $form->handleRequest($request);
        $view = $this->view($form , 400);
        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();
            $view = $this->view($entity , 200);
        }

        return $this->handleView($view);
    }

    /**
     * @abstract
     * @return Object
     */
    abstract function getNewEntity ();

    /**
     * @abstract
     * @return Object|Object[]
     */
    abstract function getFormType ();

    protected function translateAction (Request $request)
    {

    }

    /**
     * Base "list" action.
     *
     * @param Request      $request
     * @param ParamFetcher $paramFetcher
     *
     * @return Response
     */
    protected function listAction (Request $request , ParamFetcher $paramFetcher)
    {
        $offsetParam = new QueryParam();
        $offsetParam->name = "offset";
        $offsetParam->requirements = "\d+";
        $offsetParam->nullable = true;
        $paramFetcher->addParam($offsetParam);


        $limitParam = new QueryParam();
        $limitParam->name = "limit";
        $limitParam->requirements = "\d+";
        $limitParam->nullable = true;
        $paramFetcher->addParam($limitParam);

        $orderByParam = new QueryParam();
        $orderByParam->name = "orderBy";
        $orderByParam->requirements = "\d+";
        $orderByParam->nullable = true;
        $paramFetcher->addParam($orderByParam);

        $orderParam = new QueryParam();
        $orderParam->name = "order";
        $orderParam->requirements = "[a-z]+";
        $orderParam->nullable = true;
        $paramFetcher->addParam($orderParam);

        $deleted = new QueryParam();
        $deleted->name = "safeDelete";
        $deleted->requirements = "[a-z]+";
        $deleted->default = false;
        $deleted->nullable = true;
        $paramFetcher->addParam($deleted);

        $groupId = new QueryParam();
        $groupId->name = "groupId";
        $groupId->requirements = "[a-z]+";
        $groupId->nullable = true;
        $paramFetcher->addParam($groupId);

        $userId = new QueryParam();
        $userId->name = "userId";
        $userId->requirements = "[a-z]+";
        $userId->nullable = true;
        $paramFetcher->addParam($userId);

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $resultList = $this->getRepository()->findAll();
        /*
        $resultQuery = $this->getRepository()->createQueryBuilder('q');

        if ($paramFetcher->get('offset')) {
            $resultQuery->setFirstResult($paramFetcher->get('offset'));
        }
        if ($limit != null && is_int($offset)) {
            $resultQuery->setMaxResults($limit);
        }
        if ($orderBy != null && $order != null) {
            $resultQuery->orderBy($order , $orderBy);
        }

        //check role && is_admin
        //user & group

        if ($safeDelete == false) {
            $resultQuery->andWhere("q.deleted_at IS NOT NULL");
        } else {
            $resultQuery->andWhere("q.deleted_at IS NULL");
        }
         WAITING FOR GROUPS && USERS IMPLEMENTATION
        if ($groupParam != null) {
            $resultQuery->andWhere("category.name = :category2");
            $resultQuery->setParameter("category2" , "Second category");
        }

        if ($usersParam != null) {
            $resultQuery->andWhere("category.name = :category2");
            $resultQuery->setParameter("category2" , "Second category");
        }

        $resultList = $resultQuery->getQuery()->getResult();
        */


        $view       = $this->view($resultList , 200);

        return $this->handleView($view);
    }

    /**
     * @abstract
     * @return EntityRepository
     */
    abstract function getRepository ();

    /**
     * Base "read" action.
     *
     * @param Request      $request
     * @param              $id
     *
     * @return Response
     */
    protected function readAction (Request $request , $id)
    {
        $result = $this->getRepository()->findOneBy(array('id' => $id));
        $view   = $this->view($result , 200);

        return $this->handleView($view);
    }


    /**
     * Base "upload" action.
     *
     * @param Request      $request
     * @param ParamFetcher $paramFetcher
     * @param              $id
     */
    protected function updateAction (Request $request , ParamFetcher $paramFetcher , $id)
    {
    }

    /**
     * Base "delete" action.
     *
     * @param Request      $request
     * @param ParamFetcher $paramFetcher
     * @param              $id
     */
    protected function deleteAction (Request $request , ParamFetcher $paramFetcher , $id)
    {
    }

}