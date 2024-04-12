<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CalendarWeeklyController extends AbstractController
{
    #[Route('/calendar/weekly', name: 'app_calendar_weekly')]
    public function index(): Response
    {
        return $this->render('calendar_weekly/index.html.twig', [
            'controller_name' => 'CalendarWeeklyController',
        ]);
    }
}
