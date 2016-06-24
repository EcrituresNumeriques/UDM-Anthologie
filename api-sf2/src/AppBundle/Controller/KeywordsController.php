<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Keywords;
use AppBundle\Form\KeywordsType;

/**
 * Keywords controller.
 *
 * @Route("/keywords")
 */
class KeywordsController extends Controller
{
    /**
     * Lists all Keywords entities.
     *
     * @Route("/", name="keywords_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $keywords = $em->getRepository('AppBundle:Keywords')->findAll();

        return $this->render('keywords/index.html.twig', array(
            'keywords' => $keywords,
        ));
    }

    /**
     * Creates a new Keywords entity.
     *
     * @Route("/new", name="keywords_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $keyword = new Keywords();
        $form = $this->createForm('AppBundle\Form\KeywordsType', $keyword);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($keyword);
            $em->flush();

            return $this->redirectToRoute('keywords_show', array('id' => $keyword->getId()));
        }

        return $this->render('keywords/new.html.twig', array(
            'keyword' => $keyword,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Keywords entity.
     *
     * @Route("/{id}", name="keywords_show")
     * @Method("GET")
     */
    public function showAction(Keywords $keyword)
    {
        $deleteForm = $this->createDeleteForm($keyword);

        return $this->render('keywords/show.html.twig', array(
            'keyword' => $keyword,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Keywords entity.
     *
     * @Route("/{id}/edit", name="keywords_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Keywords $keyword)
    {
        $deleteForm = $this->createDeleteForm($keyword);
        $editForm = $this->createForm('AppBundle\Form\KeywordsType', $keyword);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($keyword);
            $em->flush();

            return $this->redirectToRoute('keywords_edit', array('id' => $keyword->getId()));
        }

        return $this->render('keywords/edit.html.twig', array(
            'keyword' => $keyword,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Keywords entity.
     *
     * @Route("/{id}", name="keywords_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Keywords $keyword)
    {
        $form = $this->createDeleteForm($keyword);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($keyword);
            $em->flush();
        }

        return $this->redirectToRoute('keywords_index');
    }

    /**
     * Creates a form to delete a Keywords entity.
     *
     * @param Keywords $keyword The Keywords entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Keywords $keyword)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('keywords_delete', array('id' => $keyword->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
