<?php
/**
 * Created by PhpStorm.
 * User: starwox
 * Date: 06/02/2020
 * Time: 00:37
 */

namespace App\Controller;

use App\Entity\Task;
use App\Form\EditTaskForm;
use App\Form\TaskForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    /**
     * @Route("/{filter}",
     *      name="homepage",
     *     defaults={"filter" : ""}
     * )
     */
    public function home($filter)
    {
        switch ($filter) {
            case '1':
                // Filtre "A faire"
                $task = $this->getDoctrine()->getRepository(Task::class)->findByState(1);
                break;
            case '2':
                // Filtre "En cours"
                $task = $this->getDoctrine()->getRepository(Task::class)->findByState(2);
                break;
            case '3':
                // Filtre "Terminée"
                $task = $this->getDoctrine()->getRepository(Task::class)->findByState(3);
                break;

            default:
                $task = $this->getDoctrine()->getRepository(Task::class)->sortByDateTime();
                break;

        }

        return $this->render('home/index.html.twig', [
           'controller_name' => "homepage",
           'filter' => $filter,
           'task' => $task
        ]);
    }


    /**
     * @Route("/task/add", name="add_task")
     */
    public function addTask(Request $request)
    {
        $task = new Task();
        $task->setCreatedDate(new \DateTime('now'));

        $form = $this->createForm(TaskForm::class, $task);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {

            $em = $this->getDoctrine()->getManager();

            $task->setCreatedDate(new \DateTime('now'));
            $task->setTitle($form->get('title')->getData());
            $task->setDescription($form->get('description')->getData());
            $task->setStatus($form->get('status')->getData());

            $em->persist($task);
            $em->flush();


            return $this->redirectToRoute('homepage');
        }

        return $this->render('task/add.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'add_task'
        ]);
    }

    /**
     * @Route("/task/edit-{id}", name="edit_task")
     */
    public function editTask(Request $request, $id)
    {
        $task = $this->getDoctrine()->getRepository(Task::class)->find($id);

        $form = $this->createForm(EditTaskForm::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $task->setTitle($form->get('title')->getData());
            $task->setDescription($form->get('description')->getData());
            $task->setStatus($form->get('status')->getData());
            $task->setEditedDate(new \DateTime('now'));

            $em->persist($task);
            $em->flush();


            return $this->redirectToRoute('homepage');
        }

        return $this->render('task/edit.html.twig', [
            'form' => $form->createView(),
            'id' => $id,
            'controller_name' => 'edit_task'
        ]);
    }

    /**
     * @Route("/task/delete-{id}", name="delete_task")
     */
    public function deleteTask($id)
    {
        $em = $this->getDoctrine()->getManager();
        $task = $em->getRepository(Task::class)->find($id);

        if (!$task) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $em->remove($task);
        $em->flush();

        return $this->redirectToRoute('homepage');
    }

}