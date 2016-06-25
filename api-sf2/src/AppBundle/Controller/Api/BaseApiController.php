<?php

namespace AppBundle\Controller\Api;

use Doctrine\Common\Collections\Criteria;
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
        $em         = $this->getDoctrine()->getEntityManager();

        $form = $this->createForm($entityForm , $entity , array("method" => $request->getMethod()));

        $form->handleRequest($request);
        $view = $this->view($form , 400);
        if ($form->isValid()) {

            $um   = $this->container->get('fos_user.user_manager');
            $user = $um->findUserBy(array("id" => 1));

            $entity->setUser($user);
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

    protected function performForm (Request $request , $entityForm , $entity)
    {

    }

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
        $entity         = $this->getParams()["entityTranslation"];
        $form           = $this->getParams()["entityTranslationForm"];
        $entitySelector = "set" . $this->getParams()["entityTranslationInversedBy"];
        $entity->$entitySelector($idEntity);
        $em   = $this->getDoctrine()->getEntityManager();
        $form = $this->createForm($form , $entity , array("method" => $request->getMethod()));
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
     * Base update translation
     *
     * @param Request $request
     * @param         $idEntity
     *
     * @return Response
     */
    protected function updateTranslationAction (Request $request , $idEntity)
    {

    }

    /**
     * Base delete translation
     *
     * @param Request $request
     * @param         $idEntityTranslation
     *
     * @return Response
     */
    protected function deleteTranslationAction (Request $request , $idEntityTranslation)
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

        $user = $this->get('security.token_storage')
            ->getToken()
            ->getUser();

        $repository = $this->getParams()["repository"];

        $resultQuery = $repository->createQueryBuilder('q');
        //exit(\Doctrine\Common\Util\Debug::dump());

        if ($paramFetcher->get('lang')) {
            $criteria = Criteria::create()
                ->where(Criteria::expr()->eq("langue" , $paramFetcher->get('lang')));
            //exit(\Doctrine\Common\Util\Debug::dump($resultQuery));
            $resultQuery->filterCollection($criteria);
        }

        if ($paramFetcher->get('groupId')) {
            $resultQuery->andWhere('q.group = :groupId')
                ->setParameter('groupId' , $paramFetcher->get('groupId'));
        }
        if ($paramFetcher->get('userId')) {
            $resultQuery->andWhere('q.user = :userId')
                ->setParameter('userId' , $paramFetcher->get('userId'));
        }

        if ($paramFetcher->get('offset')) {
            $resultQuery->setFirstResult($paramFetcher->get('offset'));
        }
        if ($paramFetcher->get('limit')) {
            $resultQuery->setMaxResults($paramFetcher->get('limit'));
        }
        //exit(\Doctrine\Common\Util\Debug::dump($resultQuery));
        /*
        if ($paramFetcher->get('orderByParam')) {
            $resultQuery->orderBy(':orderByParam :order');
            $resultQuery->setParameter(':orderByParam', $paramFetcher->get('orderBy'));
            $resultQuery->setParameter(':order', $paramFetcher->get('sort') ? $paramFetcher->get('sort') : null );

        }*/

        $resultList = $resultQuery->getQuery()
            ->getResult();
        $view       = $this->view($resultList , 200);

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
     * @return Response
     */
    protected function updateAction (Request $request , $id)
    {
        $repository = $this->getParams()["repository"];
        $entity     = $repository->findOneBy(array('id' => $id));
        $entityForm = $this->getParams()["entityForm"];
        $em         = $this->getDoctrine()->getEntityManager();

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
        if ($paramFetcher->get('safeDelete')) {

        } else {
            $repository->remove($entity);
        }


        $repository->flush();

    }

}