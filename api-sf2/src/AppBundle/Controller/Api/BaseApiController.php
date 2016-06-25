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
     * @param         $idEntityTranslation
     *
     * @return Response
     */
    protected function createTranslationAction (Request $request , $idEntity , $idEntityTranslation)
    {

    }

    /**
     * Base edit translation
     *
     * @param Request $request
     * @param         $idEntity
     *
     * @return Response
     */
    protected function editTranslationAction (Request $request , $idEntity)
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
            $resultQuery->join('AppBundle:' . $this->getParams()["entityTranslationName"] , 't')
                ->where('q.id = t.author')
                ->andWhere('t.language = :lang')
                ->setParameter('lang' , $paramFetcher->get('lang'));
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
        $result     = $repository->findOneBy(array('id' => $id));
        $view       = $this->view($result , 200);

        return $this->handleView($view);
    }


    /**
     * Base "upload" action.
     *
     * @param Request      $request
     * @param ParamFetcher $paramFetcher
     * @param              $id
     *
     * @return Response
     */
    protected function updateAction (Request $request , ParamFetcher $paramFetcher , $id)
    {
        $entityForm = $this->getParams()["entityForm"];
        $em         = $this->getDoctrine()->getManager();
        $entity     = $em->findOneBy(array('id' => $id));

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