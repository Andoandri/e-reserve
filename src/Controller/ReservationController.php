<?php

namespace App\Controller;

use App\Class\Reservation;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{

    #[Route('/reservation', name: 'app_reservation')]
    public function index(Reservation $reservation, EventRepository $eventRepository): Response
    {

        foreach ($reservation->get() as $id => $quantity) {
            $reservationComplete[] = [
                'event' => $eventRepository->find($id),
                'quantity' => $quantity
            ];
        }

        return $this->render('reservation/index.html.twig', [
            'events' => $reservationComplete
        ]);
    }

    #[Route('/reservation/{id}', name: 'add_to_reservation')]
    public function add($id, Reservation $reservation, EventRepository $eventRepository)
    {
        $reservation->add($id);
        $event = $eventRepository->find($id);

        return $this->render('eventplus/index.html.twig', [
            'event' => $event,
        ]);
    }
}
