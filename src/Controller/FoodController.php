<?php

namespace App\Controller;

use App\Entity\Food;
use App\Form\Food1Type;
use App\Repository\FoodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/food")
 */
class FoodController extends AbstractController
{
    /**
     * @Route("/", name="app_food_index", methods={"GET"})
     */
    public function index(FoodRepository $foodRepository): Response
    {
        return $this->render('food/index.html.twig', [
            'food' => $foodRepository->findAll(),
        ]);
    }


    /**
     * @Route("/new", name="app_food_new", methods={"GET", "POST"})
     */
    public function new(Request $request, FoodRepository $foodRepository): Response
    {
        $food = new Food();
        $form = $this->createForm(FoodType::class, $food);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $foodRepository->add($food, true);

            return $this->redirectToRoute('app_food_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('food/new.html.twig', [
            'food' => $food,
            'form' => $form,
        ]);
    }

}
