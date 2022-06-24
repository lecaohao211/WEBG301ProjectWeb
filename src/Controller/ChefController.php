<?php

namespace App\Controller;

use App\Entity\Chef;
use http\Client\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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


}
