<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class AccueilController extends AbstractController
{
    #[Route('/bluelock/accueil', name: 'accueil')]
    public function accueil()
    {
        $nombre = 20;
        return $this->render('BlueLock/pages/accueil.html.twig', ["nombres" => $nombre]);
    }

    #[Route('/bluelock/matchs', name: 'matchs')]
    public function matchs()
    {
        $nombre = 20;
        return $this->render('BlueLock/pages/match.html.twig', ["nombres" => $nombre]);
    }

    #[Route('/bluelock/equipes', name: 'equipes')]
    public function equipes()
    {
        $teams = 5;
        return $this->render('BlueLock/pages/equipe.html.twig', ["teams" => $teams]);
    }

    #[Route('/bluelock/joueurs', name: 'joueurs')]
    public function joueurs()
    {
        $player = 21;
        return $this->render('BlueLock/pages/joueur.html.twig', ["player" => $player]);
    }

    #[Route('/bluelock/stats', name: 'stats')]
    public function stats()
    {
        $arc = 5;
        return $this->render('BlueLock/pages/stats.html.twig', ["arc" => $arc]);
    }

    #[Route('/bluelock/stats/arc', name: 'stats_arc')]
    public function statsArc()
    {
        $nombre = 20;
        return $this->render('BlueLock/pages/stats_arc.html.twig', ["nombres" => $nombre]);
    }

    #[Route('/bluelock/infos', name: 'infos')]
    public function infos()
    {
        return $this->render('BlueLock/pages/info.html.twig');
    }

    #[Route('/bluelock/joueurs/details', name: 'joueurs_details')]
    public function joueursDetails()
    {
        return $this->render('BlueLock/pages/joueurs_details.html.twig');
    }

    #[Route('/bluelock/joueurs/details/stats', name: 'joueurs_details_stats')]
    public function joueursDetailsStats()
    {
        return $this->render('BlueLock/pages/details_nav/stats.html.twig');
    }

    #[Route('/bluelock/joueurs/details/matchs', name: 'joueurs_details_matchs')]
    public function joueursDetailsMatchs()
    {
        $first3 = 3;
        $last7 = 7;
        return $this->render('BlueLock/pages/details_nav/matchs.html.twig', ["first3" => $first3, "last7" => $last7]);
    }

    #[Route('/bluelock/joueurs/details/general', name: 'joueurs_details_general')]
    public function joueursDetailsGeneral()
    {
        $general = 3;
        return $this->render('BlueLock/pages/details_nav/general.html.twig', ["general" => $general]);
    }

    #[Route('/bluelock/equipes/details', name: 'equipes_details')]
    public function equipesDetails()
    {
        $nombre = 20;
        return $this->render('BlueLock/pages/equipes_details.html.twig', ["nombres" => $nombre]);
    }

    #[Route('/bluelock/equipes/details/stats', name: 'equipes_details_stats')]
    public function equipesDetailsStats()
    {
        return $this->render('BlueLock/pages/team_details_nav/stats.html.twig');
    }

    #[Route('/bluelock/equipes/details/matchs', name: 'equipes_details_matchs')]
    public function equipesDetailsMatchs()
    {
        $first3 = 3;
        $last7 = 7;
        return $this->render('BlueLock/pages/team_details_nav/matchs.html.twig', ["first3" => $first3, "last7" => $last7]);
    }

    #[Route('/bluelock/equipes/details/effectif', name: 'equipes_details_effectif')]
    public function equipesDetailsEffectif()
    {
        $gardien = 1;
        $defense = 5;
        $milieu = 10;
        $attaque = 4;
        return $this->render('BlueLock/pages/team_details_nav/effectif.html.twig', ["gardien" => $gardien, "defense" => $defense, "milieu" => $milieu, "attaque" => $attaque]);
    }
} 