<?php
namespace DevBoard\CoreBundle\Controller;

use DevBoard\Core\Project\Entity\Project;
use DevBoard\CoreBundle\Form\ProjectType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Project controller.
 */
class ProjectController extends Controller
{
    /**
     * Lists all Project entities.
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $criteria = ['user' => $this->getUser()];
        $sort     = ['projectName' => 'ASC'];
        $entities = $em->getRepository('DevBoardProject:Project')->findBy($criteria, $sort);

        return $this->render(
            'DevBoardCoreBundle:Project:index.html.twig',
            [
                'entities' => $entities,
            ]
        );
    }

    /**
     * Creates a new Project entity.
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $entity = new Project();
        $form   = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $service = $this->get('core.project.create.handler');

            $service->create($entity->getProjectName());

            /*
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($entity);
                        $em->flush();
            */

            return $this->redirect($this->generateUrl('dashboard'));
        }

        return $this->render(
            'DevBoardCoreBundle:Project:new.html.twig',
            [
                'entity' => $entity,
                'form'   => $form->createView(),
            ]
        );
    }

    /**
     * Creates a form to create a Project entity.
     *
     * @param Project $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Project $entity)
    {
        $form = $this->createForm(
            ProjectType::class,
            $entity,
            [
                'action' => $this->generateUrl('project_create'),
                'method' => 'POST',
            ]
        );

        $form->add('submit', SubmitType::class, ['label' => 'Save']);

        return $form;
    }

    /**
     * Displays a form to create a new Project entity.
     */
    public function newAction()
    {
        $entity = new Project();
        $form   = $this->createCreateForm($entity);

        return $this->render(
            'DevBoardCoreBundle:Project:new.html.twig',
            [
                'entity' => $entity,
                'form'   => $form->createView(),
            ]
        );
    }

    /**
     * Finds and displays a Project entity.
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DevBoardProject:Project')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Project entity.');
        }

        if ($entity->getUser() !== $this->getUser()) {
            throw $this->createNotFoundException('Unable to find Project entity!');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'DevBoardCoreBundle:Project:show.html.twig',
            [
                'entity'      => $entity,
                'delete_form' => $deleteForm->createView(),
            ]
        );
    }

    /**
     * Displays a form to edit an existing Project entity.
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DevBoardProject:Project')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Project entity.');
        }

        if ($entity->getUser() !== $this->getUser()) {
            throw $this->createNotFoundException('Unable to find Project entity!');
        }

        $editForm   = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'DevBoardCoreBundle:Project:edit.html.twig',
            [
                'entity'      => $entity,
                'edit_form'   => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ]
        );
    }

    /**
     * Creates a form to edit a Project entity.
     *
     * @param Project $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Project $entity)
    {
        $form = $this->createForm(
            new ProjectType(),
            $entity,
            [
                'action' => $this->generateUrl('project_update', ['id' => $entity->getId()]),
                'method' => 'PUT',
            ]
        );

        $form->add('submit', SubmitType::class, ['label' => 'Save']);

        return $form;
    }

    /**
     * Edits an existing Project entity.
     *
     * @param Request $request
     * @param         $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DevBoardProject:Project')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Project entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm   = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('project_edit', ['id' => $id]));
        }

        return $this->render(
            'DevBoardCoreBundle:Project:edit.html.twig',
            [
                'entity'      => $entity,
                'edit_form'   => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ]
        );
    }

    /**
     * Deletes a Project entity.
     *
     * @param Request $request
     * @param         $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, $id)
    {
        throw $this->createNotFoundException('@TODO: delete is not possible at this moment!');

        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em     = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DevBoardProject:Project')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Project entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('project'));
    }

    /**
     * Creates a form to delete a Project entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('project_delete', ['id' => $id]))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, ['label' => 'Delete'])
            ->getForm();
    }
}
