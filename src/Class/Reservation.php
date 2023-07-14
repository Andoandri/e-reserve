<?php

namespace App\Class;

use App\Class\Reservation as ClassReservation;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Reservation
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function add($id)
    {
        $reservation = $this->requestStack->getSession()->get('reservation', []);

        if (!empty($reservation[$id])) {
            $reservation[$id]++;
        } else {
            $reservation[$id] = 1;
        }
        $this->requestStack->getSession()->set('reservation', $reservation);
    }

    public function get()
    {
        return
            $this->requestStack->getSession()->get('reservation', []);
    }
}
