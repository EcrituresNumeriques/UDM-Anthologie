<?php

namespace AppBundle\Controller\Api;

use FOS\RestBundle\Controller\Annotations\QueryParam;
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

        $entity     = $this->getParams()["entity"];
        $entityForm = $this->getParams()["entityForm"];
        $em         = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')
            ->getToken()
            ->getUser();
        $entity->setUser($user);
        $form       = $this->createForm($entityForm , $entity , array("method" => $request->getMethod()));
        $form->handleRequest($request);
        $view = $this->view($form , 404);
        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();
            $view = $this->view($entity , 200);
        }

        return $this->handleView($view);
    }

    /**
     * @abstract
     * @return Object[]
     */
    abstract function getParams ();

    /**
     * Base create translation
     *
     * @param Request $request
     * @param         $idEntity
     *
     * @return Response
     */
    protected function createTranslationAction (Request $request , $idEntity)
    {
        $entityTranslation   = $this->getParams()["entityTranslation"];
        $formTypeTranslation = $this->getParams()["entityTranslationForm"];
        $repository          = $this->getParams()["repository"];
        $entity              = $repository->findOneBy(array('id' => $idEntity));
        $entitySetter        = $this->getParams()["entitySetter"];
        $em                  = $this->getDoctrine()->getManager();

        $user                = $this->get('security.token_storage')
            ->getToken()
            ->getUser();


        if ( !$user->hasGroup($entity->getGroup()->getName())
            || $user->getId() != $entity->getUser()->getId()) {
            $view = $this->view($entity , 403);

            return $this->handleView($view);
        }

        $entityTranslation->setUser($user);
        $form                = $this->createForm($formTypeTranslation , $entityTranslation , array(
            "method" => $request->getMethod()
        ));
        $form->handleRequest($request);
        $form->getErrors();
        $view = $this->view($form , 400);
        if ($form->isValid()) {

            $entityTranslation->$entitySetter($entity);
            $em->persist($entityTranslation);
            $em->flush();
            $view = $this->view($entity , 200);
        }

        return $this->handleView($view);
    }

    /**
     * Base update translation
     *
     * @param Request $request
     * @param         $idTranslation
     *
     * @return Response
     */
    protected function updateTranslationAction (Request $request , $idTranslation)
    {

        $repositoryTranslation = $this->getParams()["repositoryTranslation"];
        $entityTranslation     = $repositoryTranslation->findOneBy(array('id' => $idTranslation));
        $formTranslation       = $this->getParams()["entityTranslationForm"];
        $user                  = $this->get('security.token_storage')
            ->getToken()
            ->getUser();
        if ( !$user->hasGroup($entityTranslation->getGroup()->getName())
            || $user->getId() != $entityTranslation->getUser()->getId()) {
            $view = $this->view($entityTranslation , 403);

            return $this->handleView($view);
        }
        $em   = $this->getDoctrine()->getManager();
        $form = $this->createForm($formTranslation , $entityTranslation , array("method" => $request->getMethod()));
        $view = $this->view($form , 400);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->persist($entityTranslation);
            $em->flush();
            $view = $this->view($entityTranslation , 200);
        }

        return $this->handleView($view);
    }

    /**
     * Base delete translation
     *
     * @param Request      $request
     * @param ParamFetcher $paramFetcher
     * @param              $id
     *
     * @return Response
     */
    protected function deleteTranslationAction (Request $request , ParamFetcher $paramFetcher , $id)
    {
        $safeDeleteParam               = new QueryParam();
        $safeDeleteParam->name         = "safeDelete";
        $safeDeleteParam->requirements = "\d+";
        $safeDeleteParam->nullable     = true;
        $paramFetcher->addParam($safeDeleteParam);

        $repository        = $this->getParams()["repositoryTranslation"];
        $entityTranslation = $repository->findOneBy(array('id' => $id));
        $user              = $this->get('security.token_storage')
            ->getToken()
            ->getUser();

        if ( !$entityTranslation) {
            $view = $this->view($entityTranslation , 400);

            return $this->handleView($view);
        }

        if ( !$user->hasGroup($entityTranslation->getGroup()->getName())
            || $user->getId() != $entityTranslation->getUser()->getId()) {
            $view = $this->view($entityTranslation , 403);

            return $this->handleView($view);
        }

        $em = $this->getDoctrine()->getManager();
        if ($paramFetcher->get('safeDelete')) {
            $eventManager = $em->getEventManager();
            $subscriber   = $this->get('knp.doctrine_behaviors.softdeletable_subscriber');
            $eventManager->removeEventListener($subscriber->getSubscribedEvents() , $subscriber);
            $em->remove($entityTranslation);
            $em->flush();
            $eventManager->addEventSubscriber($subscriber);
        } else {
            $em->remove($entityTranslation);
            $em->flush();
        }
        $view = $this->view($entityTranslation , 200);

        return $this->handleView($view);
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
        $offsetParam               = new QueryParam();
        $offsetParam->name         = "offset";
        $offsetParam->requirements = "\d+";
        $offsetParam->nullable     = true;
        $paramFetcher->addParam($offsetParam);

        $limitParam               = new QueryParam();
        $limitParam->name         = "limit";
        $limitParam->requirements = "\d+";
        $limitParam->nullable     = true;
        $paramFetcher->addParam($limitParam);

        $orderByParam               = new QueryParam();
        $orderByParam->name         = "orderBy";
        $orderByParam->requirements = "[a-z]+";
        $orderByParam->nullable     = true;
        $paramFetcher->addParam($orderByParam);

        $sortParam               = new QueryParam();
        $sortParam->name         = "sort";
        $sortParam->requirements = "[a-z]+";
        $sortParam->nullable     = true;
        $paramFetcher->addParam($sortParam);

        $deletedParam               = new QueryParam();
        $deletedParam->name         = "deleted";
        $deletedParam->requirements = "\d+";
        $deletedParam->default      = 0;
        $deletedParam->nullable     = true;
        $paramFetcher->addParam($deletedParam);

        $groupParam               = new QueryParam();
        $groupParam->name         = "groupId";
        $groupParam->requirements = "\d+";
        $groupParam->nullable     = true;
        $paramFetcher->addParam($groupParam);

        $userParam               = new QueryParam();
        $userParam->name         = "userId";
        $userParam->requirements = "\d+";
        $userParam->nullable     = true;
        $paramFetcher->addParam($userParam);

        $lang               = new QueryParam();
        $lang->name         = "lang";
        $lang->requirements = "\d+";
        $lang->nullable     = true;
        $paramFetcher->addParam($lang);

        $em = $this->getDoctrine()
            ->getManager();

        //filters
        if ($paramFetcher->get('lang')) {
            $em->getFilters()
                ->enable('translatable_class')
                ->setParameter('lang' , $paramFetcher->get('lang'));
        }

        if ($paramFetcher->get('groupId')) {
            $em->getFilters()
                ->enable('group_acl_class')
                ->setParameter('groupId' , $paramFetcher->get('groupId'));
        }

        if ($paramFetcher->get('userId')) {
            $em->getFilters()
                ->enable('user_acl_class')
                ->setParameter('userId' , $paramFetcher->get('userId'));
        }

        if ($paramFetcher->get('deleted') == 1) {
            $em->getFilters()
                ->enable('soft_deletable_class')
                ->setParameter('deleted' , $paramFetcher->get('deleted'));
        }

        $repository   = $this->getParams()["repository"];
        $queryBuilder = $repository->createQueryBuilder('q');

        if ($paramFetcher->get('offset')) {
            $queryBuilder->setFirstResult($paramFetcher->get('offset'));
        }
        if ($paramFetcher->get('limit')) {
            $queryBuilder->setMaxResults($paramFetcher->get('limit'));
        }

        $result = $queryBuilder->getQuery()
            ->getResult();

        $view = $this->view($result , 200);

        return $this->handleView($view);
    }

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
        $repository = $this->getParams()["repository"];
        $entity     = $repository->findOneBy(array('id' => $id));
        $view       = $this->view($entity , 200);

        return $this->handleView($view);
    }


    /**
     * Base "update" action.
     *
     * @param Request      $request
     * @param              $id
     *
     *
     * @return Response
     */
    protected function updateAction (Request $request , $id)
    {
        $repository = $this->getParams()["repository"];
        $entity     = $repository->findOneBy(array('id' => $id));
        $entityForm = $this->getParams()["entityForm"];
        $em         = $this->getDoctrine()->getManager();
        $user       = $this->get('security.token_storage')
            ->getToken()
            ->getUser();

        if ( !$user->hasGroup($entity->getGroup()->getName())
            || $user->getId() != $entity->getUser()->getId()
        ) {
            $view = $this->view($entity , 403);

            return $this->handleView($view);
        }

        $form = $this->createForm($entityForm , $entity , array("method" => $request->getMethod()));
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
     * Base "delete" action.
     *
     * @param Request      $request
     * @param ParamFetcher $paramFetcher
     * @param              $id
     *
     * @return Response
     */
    protected function deleteAction (Request $request , ParamFetcher $paramFetcher , $id)
    {
        $safeDeleteParam               = new QueryParam();
        $safeDeleteParam->name         = "safeDelete";
        $safeDeleteParam->requirements = "\d+";
        $safeDeleteParam->nullable     = true;
        $paramFetcher->addParam($safeDeleteParam);

        $repository = $this->getParams()["repository"];
        $entity     = $repository->findOneBy(array('id' => $id));
        if ( !$entity) {
            $view = $this->view($entity , 400);

            return $this->handleView($view);
        }

        $user = $this->get('security.token_storage')
            ->getToken()
            ->getUser();

        if ( !$user->hasGroup($entity->getGroup()->getName())
            || $user->getId() != $entity->getUser()->getId()
        ) {
            $view = $this->view($entity , 403);

            return $this->handleView($view);
        }

        $em = $this->getDoctrine()->getManager();
        if ($paramFetcher->get('safeDelete')) {
            $eventManager = $em->getEventManager();
            $subscriber   = $this->get('knp.doctrine_behaviors.softdeletable_subscriber');
            $eventManager->removeEventListener($subscriber->getSubscribedEvents() , $subscriber);
            $em->remove($entity);
            $em->flush();
            $eventManager->addEventSubscriber($subscriber);
        } else {
            $em->remove($entity);
            $em->flush();
        }
        $view = $this->view($entity , 200);

        return $this->handleView($view);
    }

}