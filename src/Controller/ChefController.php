<?php

namespace App\Controller;

use App\Entity\Chef;
use App\Form\ChefType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChefController extends AbstractController
{
    /**
     * @Route("/Chef", name="app_chef")
     */
    public function index(): Response
    {
        return $this->render('chef/index.html.twig', [
            'controller_name' => 'ChefController',
        ]);
    }

    /**
     * @Route("/chef", name="chef_list")
     */
    public function listAction()
    {
        $chefs = $this->getDoctrine()
            ->getRepository(Chef::class)
            ->findAll();
        return $this->render('Chef/index.html.twig',['chefs'=> $chefs
        ]);
    }

    /**
     * @Route("/chef/details/{id}", name="chef_details")
     */
    public
    function detailsAction($id)
    {
        $chefs = $this->getDoctrine()
            ->getRepository(Chef::class)
            ->find($id);

        return $this->render('chef/detail.html.twig', [
            'chefs' => $chefs
        ]);
    }
    /**
     * @Route("/chef/delete/{id}", name="chef_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $chef = $em->getRepository(Chef::class)->find($id);
        $em->remove($chef);
        $em->flush();

        $this->addFlash(
            'error',
            'A Chef deleted'
        );

        return $this->redirectToRoute('chef_list');
    }

    /**
     * @Route("/chef/create", name="chef_create", methods={"GET","POST"})
     */
    public function createAction(Request $request)
    {
        $chef = new Chef();
        $form = $this->createForm(ChefType::class, $chef);

        if ($this->saveChanges($form, $request, $chef)) {
            $this->addFlash(
                'notice',
                'Chef Added'
            );

            return $this->redirectToRoute('chef_list');
        }

        return $this->render('chef/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function saveChanges($form, $request, $chef)
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $chef->setName($request->request->get('chef')['name']);
            $chef->setGender($request->request->get('chef')['gender']);
            $chef->setSalary($request->request->get('chef')['salary']);
            $em = $this->getDoctrine()->getManager();
            $em->persist($chef);
            $em->flush();

            return true;
        }
        return false;
    }







}
