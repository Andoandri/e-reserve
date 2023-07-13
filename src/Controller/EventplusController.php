<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EventRepository;

class EventplusController extends AbstractController
{
    #[Route('/eventplus/{id}/', name: 'app_eventplus')]
    public function index(EventRepository $eventRepository, $id): Response
    {
        $event = $eventRepository->find($id);

        return $this->render('eventplus/index.html.twig', [
            'controller_name' => 'EventplusController',
            'event' => $event,
            'id' => $id
        ]);
    }
}
