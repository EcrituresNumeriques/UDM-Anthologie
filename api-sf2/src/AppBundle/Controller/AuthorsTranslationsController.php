<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\AuthorsTranslations;
use AppBundle\Form\AuthorsTranslationsType;

/**
 * AuthorsTranslations controller.
 *
 * @Route("/authorstranslations")
 */
class AuthorsTranslationsController extends Controller
{
    /**
     * Lists all AuthorsTranslations entities.
     *
     * @Route("/", name="authorstranslations_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $authorsTranslations = $em->getRepository('AppBundle:AuthorsTranslations')->findAll();

        return $this->render('authorstranslations/index.html.twig', array(
            'authorsTranslations' => $authorsTranslations,
        ));
    }

    /**
     * Creates a new AuthorsTranslations entity.
     *
     * @Route("/new", name="authorstranslations_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $authorsTranslation = new AuthorsTranslations();
        $form = $this->createForm('AppBundle\Form\AuthorsTranslationsType', $authorsTranslation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($authorsTranslation);
            $em->flush();

            return $this->redirectToRoute('authorstranslations_show', array('id' => $authorsTranslation->getId()));
        }

        return $this->render('authorstranslations/new.html.twig', array(
            'authorsTranslation' => $authorsTranslation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a AuthorsTranslations entity.
     *
     * @Route("/{id}", name="authorstranslations_show")
     * @Method("GET")
     */
    public function showAction(AuthorsTranslations $authorsTranslation)
    {
        $deleteForm = $this->createDeleteForm($authorsTranslation);

        return $this->render('authorstranslations/show.html.twig', array(
            'authorsTranslation' => $authorsTranslation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing AuthorsTranslations entity.
     *
     * @Route("/{id}/edit", name="authorstranslations_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, AuthorsTranslations $authorsTranslation)
    {
        $deleteForm = $this->createDeleteForm($authorsTranslation);
        $editForm = $this->createForm('AppBundle\Form\AuthorsTranslationsType', $authorsTranslation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($authorsTranslation);
            $em->flush();

            return $this->redirectToRoute('authorstranslations_edit', array('id' => $authorsTranslation->getId()));
        }

        return $this->render('authorstranslations/edit.html.twig', array(
            'authorsTranslation' => $authorsTranslation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a AuthorsTranslations entity.
     *
     * @Route("/{id}", name="authorstranslations_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, AuthorsTranslations $authorsTranslation)
    {
        $form = $this->createDeleteForm($authorsTranslation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($authorsTranslation);
            $em->flush();
        }

        return $this->redirectToRoute('authorstranslations_index');
    }

    /**
     * Creates a form to delete a AuthorsTranslations entity.
     *
     * @param AuthorsTranslations $authorsTranslation The AuthorsTranslations entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AuthorsTranslations $authorsTranslation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('authorstranslations_delete', array('id' => $authorsTranslation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
