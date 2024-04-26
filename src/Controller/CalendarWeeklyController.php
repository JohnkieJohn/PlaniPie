<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\WeekDayRepository;
use App\Repository\MonthRepository;

class CalendarWeeklyController extends AbstractController
{
    private $month_repository;
    private $week_day_repository;

    public function __construct(MonthRepository $monthRepository, WeekDayRepository $weekDayRepository)
    {
        $this->month_repository = $monthRepository;
        $this->week_day_repository = $weekDayRepository;
    }

    #[Route('/calendar/weekly', name: 'app_calendar_weekly')]
    public function index(): Response
    {
        // Récupére le numéro de la semaine en cours
        $current_week_number = (new \DateTime())->format('W');

        $name_days_week = $this->week_day_repository->findAll();
        $name_months = $this->month_repository->findAll();

        $hours_day = [];
        for ($hour = 0; $hour < 24; $hour++) {
            for ($minute = 0; $minute < 60; $minute += 15) {
                $time = str_pad($hour, 2, '0', STR_PAD_LEFT) . ':' . str_pad($minute, 2, '0', STR_PAD_LEFT);
                $hours_day[] = $time;
            }
        }

        return $this->render('calendar_weekly/index.html.twig', [
            'days_of_week' => $name_days_week,
            'hours_of_day' => $hours_day,
        ]);
    }
}
