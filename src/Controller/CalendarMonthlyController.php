<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\WeekDayRepository;
use App\Repository\MonthRepository;


class CalendarMonthlyController extends AbstractController
{
    #[Route('/calendar/monthly', name: 'app_calendar_monthly')]
    public function index(WeekDayRepository $week_day_repository, MonthRepository $month_repository): Response
    {
        // Crée une nouvelle instance de DateTime pour obtenir la date actuelle.
        $current_date = new \DateTime();
        // Récupère le numéro du mois actuel au format numérique (de 1 à 12)
        $current_month_number = $current_date->format('n');

        // Récupère tous les jours de la semaine à partir du repo WeekDayRepository.
        $days_of_week = $week_day_repository->findAll();
        // Recherche le mois correspondant au numéro du mois actuel dans le repo MonthRepository
        $current_month_match = $month_repository->find($current_month_number);
        // Récupère le nom du mois correspondant au numéro du mois actuel s'il existe, sinon null
        $current_month_name = $current_month_match ? $current_month_match->getNameMonth() : null;

        // Retourne la vue avec les jours de la semaine et le nom du mois actuel
        return $this->render('calendar_monthly/index.html.twig', [
            'days_of_week' => $days_of_week,
            'current_month_name' => $current_month_name,
        ]);
    }
}
