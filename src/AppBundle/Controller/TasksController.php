<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Task;
use AppBundle\Form\Type\TaskType;

class TasksController extends Controller
{
    public function indexAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Task');
        $tasks = $repository->findAll();

        $message = $request->query->get('message');
        switch ($message) {
            case 'added':
                $message = 'Task added successfully.';
                break;
            case 'edited':
                $message = 'Task edited successfully.';
                break;
            case 'deleted':
                $message = 'Task deleted successfully.';
                break;
            default:
                $message = null;
                break;
        }

        return $this->render('AppBundle:tasks:index.html.twig', [
            'tasks'   => $tasks,
            'message' => $message
        ]);
    }

    public function addAction(Request $request)
    {
        $error = null;
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task->setUser($this->getUser());
            try {
                $em = $this->getDoctrine()->getManager();
            
                $em->persist($task);
                $em->flush();

                return $this->redirectToRoute('_home', ['message' => 'added']);
            } catch (\Exception $e) {
                $error = $e->getMessage();
            }
        }

        return $this->render('AppBundle:tasks:form.html.twig', [
            'form'  => $form->createView(),
            'error' => $error
        ]);
    }

    public function editAction(Request $request, $id)
    {
        $error = null;
        if ($id == null) {
            return $this->redirectToRoute('_home');
        }

        $repository = $this->getDoctrine()->getRepository('AppBundle:Task');
        $task = $repository->find($id);

        if ($task == null) {
            return $this->redirectToRoute('_home');
        }

        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task->setUser($this->getUser());
            try {
                $em = $this->getDoctrine()->getManager();
            
                $em->persist($task);
                $em->flush();

                return $this->redirectToRoute('_home', ['message' => 'edited']);
            } catch (\Exception $e) {
                $error = $e->getMessage();
            }
        }

        return $this->render('AppBundle:tasks:form.html.twig', [
            'form'  => $form->createView(),
            'error' => $error
        ]);
    }

    public function deleteAction(Request $request, $id)
    {
        $error = null;
        if ($id == null) {
            return $this->redirectToRoute('_home');
        }

        $repository = $this->getDoctrine()->getRepository('AppBundle:Task');
        $task = $repository->find($id);

        if ($task == null) {
            return $this->redirectToRoute('_home');
        }

        $form = $this->createFormBuilder()
            ->add('delete', SubmitType::class, [
                'label' => 'Delete Task',
                'attr'  => ['class' => 'btn btn-danger']
            ])
            ->getForm();

        if ($request->isMethod('POST')) {
            try {
                $em = $this->getDoctrine()->getManager();
            
                $em->remove($task);
                $em->flush();

                return $this->redirectToRoute('_home', ['message' => 'deleted']);
            } catch (\Exception $e) {
                $error = $e->getMessage();
            }
        }

        return $this->render('AppBundle:tasks:delete.html.twig', [
            'task'  => $task,
            'form'  => $form->createView(),
            'error' => $error
        ]);
    }
}
