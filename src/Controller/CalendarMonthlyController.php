<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\WeekDayRepository;
use App\Repository\MonthRepository;


class CalendarMonthlyController extends AbstractController
{
    private $month_repository;
    private $week_day_repository;

    public function __construct(MonthRepository $monthRepository, WeekDayRepository $weekDayRepository)
    {
        $this->month_repository = $monthRepository;
        $this->week_day_repository = $weekDayRepository;
    }

    #[Route('/calendar/monthly/{monthId?}/{year?}', name: 'app_calendar_monthly')]
    public function index(Request $request): Response
    {
        // Récupère tous les noms des jours de la semaine et des mois 
        $name_days_week = $this->week_day_repository->findAll();
        $name_months = $this->month_repository->findAll();
        
        $current_date = new \DateTime();
        $days_of_month = [];

        //Récupère le mois et l'année actuels
        $current_month_number = $current_date->format('n');
        $current_year = $current_date->format('Y');

        // Récupère le mois et l'année sélectionnés à partir de la requête
        $selected_month = $request->attributes->get('monthId');
        if ($selected_month) {
            $current_month_number = $selected_month;
        }
        $selected_year = $request->attributes->get('year');
        if ($selected_year) {
            $current_year = $selected_year;
        }
        
        // Trouve le mois précédent
        $previous_month_index = ($current_month_number - 2 + 12) % 12;
        $previous_month = $name_months[$previous_month_index];
        
        // Trouve le mois suivant
        $next_month_index = ($current_month_number % 12);
        $next_month = $name_months[$next_month_index];

        // Appel de la méthode pour récupérer le nom du mois depuis MonthRepository
        $current_month_name = $this->month_repository->getMonthNameFromDb($current_month_number);

        // Appel de la méthode pour récupérer les jours du mois en cours
        $days_of_month = $this->getDaysInMonth($current_month_number, $current_year);

        // Retourne la vue avec les infos relatives à la date
        return $this->render('calendar_monthly/index.html.twig', [
            'days_of_week' => $name_days_week,
            'current_month_name' => $current_month_name,
            'days_of_month' => $days_of_month,
            'name_months' => $name_months,
            'previous_month' => $previous_month,
            'next_month' => $next_month,
            'current_year' => $current_year,
            'current_month_number' => $current_month_number
        ]);
    }

    // Récupère les jours d'un mois donné
    private function getDaysInMonth(int $month, int $year): array
    {
        $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $days_of_month = [];

        for ($day_number = 1; $day_number <= $days_in_month; $day_number++) {
            $current_day = new \DateTime(sprintf('%s-%s-%s', $year, $month, $day_number));
            $days_of_month[] = $current_day;
        }
        return $days_of_month;
    }
}
