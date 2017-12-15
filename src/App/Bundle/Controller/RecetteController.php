<?php

namespace App\Bundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\Bundle\Entity\Recette;
use App\Bundle\Form\RecetteType;

/**
 * Recette controller.
 *
 */
class RecetteController extends Controller
{

    /**
     * Lists all Recette entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Recette')->findAll();

        return $this->render('AppBundle:Recette:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Recette entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Recette();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('recette_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:Recette:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Recette entity.
    *
    * @param Recette $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Recette $entity)
    {
        $form = $this->createForm(new RecetteType(), $entity, array(
            'action' => $this->generateUrl('recette_create'),
            'method' => 'POST',
        ));

       // $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Recette entity.
     *
     */
    public function newAction()
    {
        $entity = new Recette();
        $form   = $this->createCreateForm($entity);

        return $this->render('AppBundle:Recette:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Recette entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Recette')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recette entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Recette:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Recette entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Recette')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recette entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Recette:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Recette entity.
    *
    * @param Recette $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Recette $entity)
    {
        $form = $this->createForm(new RecetteType(), $entity, array(
            'action' => $this->generateUrl('recette_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Recette entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Recette')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recette entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('recette_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:Recette:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Recette entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Recette')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Recette entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('recette'));
    }

    /**
     * Creates a form to delete a Recette entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('recette_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
