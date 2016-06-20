<?php
/**
 * Created by PhpStorm.
 * User: karael
 * Date: 21/06/2016
 * Time: 01:05
 */

namespace Acme\ApiBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use JMS\Serializer\SerializationContext;

use AppBundle\Entity\Author;

class AuthorController extends FOSRestController
{
    /**
     * Create a Post entity.
     *
     * @View(statusCode=201, serializerEnableMaxDepthChecks=true)
     * @param Request $request
     * @return Response
     *
     */
    public function postAuthorAction(Request $request)
    {
        $entity = new Author();
        $form = $this->createForm(new Author(), $entity, array("method" => "POST"));
        $this->removeExtraFields($request, $form);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $entity;
        }

        return FOSView::create(array('errors' => $form->getErrors()), Codes::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Update a Post entity.
     *
     * @View(serializerEnableMaxDepthChecks=true)
     *
     * @param Request $request
     * @param $entity
     *
     * @return Response
     */
    public function putAuthorAction(Request $request, Post $entity)
    {
        try {
            $em = $this->getDoctrine()->getManager();
            $request->setMethod('PATCH'); //Treat all PUTs as PATCH
            $form = $this->createForm(new Author(), $entity, array("method" => $request->getMethod()));
            $this->removeExtraFields($request, $form);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->flush();

                return $entity;
            }

            return FOSView::create(array('errors' => $form->getErrors()), Codes::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Partial Update to a Post entity.
     *
     * @View(serializerEnableMaxDepthChecks=true)
     *
     * @param Request $request
     * @param $entity
     *
     * @return Response
     */
    public function patchAuthorAction(Request $request, Post $entity)
    {
        return $this->putAction($request, $entity);
    }

    /**
     * Delete a Post entity.
     *
     * @View(statusCode=204)
     *
     * @param Request $request
     * @param $entity
     * @internal param $id
     *
     * @return Response
     */
    public function deleteAuthorAction(Request $request, Post $entity)
    {
        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            $em->flush();

            return null;
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getDemosAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if (false === $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {

        }

        //...
        // Do something with the fully authenticated user.
        // ...
    }
}