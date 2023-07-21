<?php

namespace App\Controller;

use App\Repository\EventRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(EventRepository $eventRepository, CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->findAll();

        $events = $eventRepository->findAll();

        return $this->render('home_page/index.html.twig', [
            'events' => $events,
            'categories'=>$category
        ]);
    }
}
