<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\KeywordsType;
use AppBundle\Form\KeywordsTypeType;

/**
 * KeywordsType controller.
 *
 * @Route("/keywordstype")
 */
class KeywordsTypeController extends Controller
{
    /**
     * Lists all KeywordsType entities.
     *
     * @Route("/", name="keywordstype_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $keywordsTypes = $em->getRepository('AppBundle:KeywordsType')->findAll();

        return $this->render('keywordstype/index.html.twig', array(
            'keywordsTypes' => $keywordsTypes,
        ));
    }

    /**
     * Creates a new KeywordsType entity.
     *
     * @Route("/new", name="keywordstype_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $keywordsType = new KeywordsType();
        $form = $this->createForm('AppBundle\Form\KeywordsTypeType', $keywordsType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($keywordsType);
            $em->flush();

            return $this->redirectToRoute('keywordstype_show', array('id' => $keywordsType->getId()));
        }

        return $this->render('keywordstype/new.html.twig', array(
            'keywordsType' => $keywordsType,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a KeywordsType entity.
     *
     * @Route("/{id}", name="keywordstype_show")
     * @Method("GET")
     */
    public function showAction(KeywordsType $keywordsType)
    {
        $deleteForm = $this->createDeleteForm($keywordsType);

        return $this->render('keywordstype/show.html.twig', array(
            'keywordsType' => $keywordsType,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing KeywordsType entity.
     *
     * @Route("/{id}/edit", name="keywordstype_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, KeywordsType $keywordsType)
    {
        $deleteForm = $this->createDeleteForm($keywordsType);
        $editForm = $this->createForm('AppBundle\Form\KeywordsTypeType', $keywordsType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($keywordsType);
            $em->flush();

            return $this->redirectToRoute('keywordstype_edit', array('id' => $keywordsType->getId()));
        }

        return $this->render('keywordstype/edit.html.twig', array(
            'keywordsType' => $keywordsType,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a KeywordsType entity.
     *
     * @Route("/{id}", name="keywordstype_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, KeywordsType $keywordsType)
    {
        $form = $this->createDeleteForm($keywordsType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($keywordsType);
            $em->flush();
        }

        return $this->redirectToRoute('keywordstype_index');
    }

    /**
     * Creates a form to delete a KeywordsType entity.
     *
     * @param KeywordsType $keywordsType The KeywordsType entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(KeywordsType $keywordsType)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('keywordstype_delete', array('id' => $keywordsType->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
