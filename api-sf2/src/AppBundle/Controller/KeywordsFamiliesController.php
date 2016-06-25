<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\KeywordsFamilies;
use AppBundle\Form\KeywordsFamiliesType;

/**
 * KeywordsFamilies controller.
 *
 * @Route("/keywordsfamilies")
 */
class KeywordsFamiliesController extends Controller
{
    /**
     * Lists all KeywordsFamilies entities.
     *
     * @Route("/", name="keywordsfamilies_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $keywordsFamilies = $em->getRepository('AppBundle:KeywordsFamilies')->findAll();

        return $this->render('keywordsfamilies/index.html.twig', array(
            'keywordsFamilies' => $keywordsFamilies,
        ));
    }

    /**
     * Creates a new KeywordsFamilies entity.
     *
     * @Route("/new", name="keywordsfamilies_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $keywordsFamily = new KeywordsFamilies();
        $form = $this->createForm('AppBundle\Form\KeywordsFamiliesType', $keywordsFamily);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($keywordsFamily);
            $em->flush();

            return $this->redirectToRoute('keywordsfamilies_show', array('id' => $keywordsFamily->getId()));
        }

        return $this->render('keywordsfamilies/new.html.twig', array(
            'keywordsFamily' => $keywordsFamily,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a KeywordsFamilies entity.
     *
     * @Route("/{id}", name="keywordsfamilies_show")
     * @Method("GET")
     */
    public function showAction(KeywordsFamilies $keywordsFamily)
    {
        $deleteForm = $this->createDeleteForm($keywordsFamily);

        return $this->render('keywordsfamilies/show.html.twig', array(
            'keywordsFamily' => $keywordsFamily,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing KeywordsFamilies entity.
     *
     * @Route("/{id}/edit", name="keywordsfamilies_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, KeywordsFamilies $keywordsFamily)
    {
        $deleteForm = $this->createDeleteForm($keywordsFamily);
        $editForm = $this->createForm('AppBundle\Form\KeywordsFamiliesType', $keywordsFamily);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($keywordsFamily);
            $em->flush();

            return $this->redirectToRoute('keywordsfamilies_edit', array('id' => $keywordsFamily->getId()));
        }

        return $this->render('keywordsfamilies/edit.html.twig', array(
            'keywordsFamily' => $keywordsFamily,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a KeywordsFamilies entity.
     *
     * @Route("/{id}", name="keywordsfamilies_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, KeywordsFamilies $keywordsFamily)
    {
        $form = $this->createDeleteForm($keywordsFamily);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($keywordsFamily);
            $em->flush();
        }

        return $this->redirectToRoute('keywordsfamilies_index');
    }

    /**
     * Creates a form to delete a KeywordsFamilies entity.
     *
     * @param KeywordsFamilies $keywordsFamily The KeywordsFamilies entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(KeywordsFamilies $keywordsFamily)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('keywordsfamilies_delete', array('id' => $keywordsFamily->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
