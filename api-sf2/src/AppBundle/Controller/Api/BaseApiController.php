<?php

namespace AppBundle\Controller\Api;

use Doctrine\ORM\EntityRepository;
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

        //user & group
        $user   = $this->get('security.token_storage')->getToken()->getUser();
        $groups = $user->getGroups();

        //query params
        $offset = $paramFetcher->get('offset');
        $offset = ($offset == null) ? 0 : $offset;
        $limit  = $paramFetcher->get('limit');
        $limit  = ($limit == null) ? 0 : $offset;
        $order  = $paramFetcher->get('limit');
        $order  = ($limit == null) ? array() : $order;

        //criterias
        $safeDelete = $paramFetcher->get('safeDelete');
        $groupParam = $paramFetcher->get('group');
        $groupParam = ($groupParam == null) ? null : $groupParam;


        $criteria = array();

        $resultList = $this->getRepository()->findBy(
            $criteria ,
            $order ,
            $limit ,
            $offset
        );

        $view = $this->view($resultList , 200);

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
     * @param Request $request
     * @param         $id
     */
    protected function readAction (Request $request , $id)
    {

    }


    /**
     * Base "upload" action.
     *
     * @param Request $request
     * @param         $id
     */
    protected function updateAction (Request $request , $id)
    {
    }

    /**
     * Base "delete" action.
     *
     * @param $id
     */
    protected function deleteAction ($id)
    {
    }

}