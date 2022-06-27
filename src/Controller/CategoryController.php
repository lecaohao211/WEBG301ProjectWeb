<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{


    /**
     * @Route("/category", name="app_category")
     */
    public function index()
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();
        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }
    /**
     * @Route("/CategoryController/details/{id}", name="category_details")
     */
    public
    function detailsAction($id)
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->find($id);

        return $this->render('category/details.html.twig', [
            'categories' => $categories,
        ]);
    }
    /**
     * @Route("/category/create", name="category_create", methods={"GET","POST"})
     */
    public function createAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);

        if ($this->saveChanges($form, $request, $category)) {
            $this->addFlash(
                'notice',
                'Category Added'
            );

            return $this->redirectToRoute('app_category');
        }

        return $this->render('category/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function saveChanges($form, $request, $category)
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category->setName($request->request->get('category')['name']);
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return true;
        }
        return false;
    }
    /**
     * @Route("/category/edit/{id}", name="category_edit")
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository(Category::class)->find($id);

        $form = $this->createForm(CategoryType::class, $category);

        if ($this->saveChanges($form, $request, $category)) {
            $this->addFlash(
                'notice',
                'Category Edited'
            );
            return $this->redirectToRoute('app_category');
        }
        return $this->render('category/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }



}
