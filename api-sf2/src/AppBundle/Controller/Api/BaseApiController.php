<?php

namespace AppBundle\Controller\Api;

use FOS\RestBundle\Controller\FOSRestController;
use Doctrine\ORM\EntityRepository;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseApiController extends FOSRestController
{
    
    /**
     * @abstract
     * @return EntityRepository
     */
    abstract function getRepository();

    /**
     * @abstract
     * @return Object
     */
    abstract function getNewEntity();

    /**
     * @abstract
     * @return Object
     */
    abstract function getFormType();

    /**
     * Base create action.
     *
     * @param Request $request
     * @return Response
     */
    protected function createAction(Request $request) {

        $entity = $this->getNewEntity();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm($this->getFormType(), $entity, array("method" => $request->getMethod()));
        $form->handleRequest($request);
        $view = $this->view($form, 400);
        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();
            $view = $this->view($entity, 200);
        }
        return $this->handleView($view);
    }

    protected function translateAction(Request $request){
        
    }

    /**
     * Base "list" action.
     *
     * @return Response
     */
    protected function listAction(Request $request, ParamFetcherInterface $paramFetcher) {

        $offset = $paramFetcher->get('offset');
        $offset = ($offset == null) ? 0 : $offset;
        $limit = $paramFetcher->get('limit');
        $limit = ($limit == null) ? 0 : $offset;
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $group = $userId->getGroups();
        $view = $this->view($user, 200);
        return $this->handleView($view);
    }

    /**
     * Base "read" action.
     *
     */
    protected function readAction() {

    }


    /**
     * Base "upload" action.
     *
     */
    protected function updateAction() {
    }

    /**
     * Base "delete" action.
     *
     */
    protected function deleteAction() {
    }
    
}