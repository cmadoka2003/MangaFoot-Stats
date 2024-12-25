<?php

namespace App\Controller;

use App\Entity\PlayersTeam;
use App\Form\PlayersTeamType;
use App\Repository\PlayersTeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/players/team')]
final class PlayersTeamController extends AbstractController{
    #[Route(name: 'app_players_team_index', methods: ['GET'])]
    public function index(PlayersTeamRepository $playersTeamRepository): Response
    {
        return $this->render('admin/players_team/index.html.twig', [
            'players_teams' => $playersTeamRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_players_team_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PlayersTeamRepository $playersTeamRepository): Response
    {
        $playersTeam = new PlayersTeam();
        $form = $this->createForm(PlayersTeamType::class, $playersTeam);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $playersTeamRepository->save($playersTeam, true);
            return $this->redirectToRoute('app_players_team_index');
        }

        return $this->render('admin/players_team/new.html.twig', [
            'players_team' => $playersTeam,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_players_team_show', methods: ['GET'])]
    public function show(PlayersTeam $playersTeam): Response
    {
        return $this->render('admin/players_team/show.html.twig', [
            'players_team' => $playersTeam,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_players_team_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PlayersTeam $playersTeam, PlayersTeamRepository $playersTeamRepository): Response
    {
        $form = $this->createForm(PlayersTeamType::class, $playersTeam);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $playersTeamRepository->save($playersTeam, true);
            return $this->redirectToRoute('app_players_team_index');
        }

        return $this->render('admin/players_team/edit.html.twig', [
            'players_team' => $playersTeam,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_players_team_delete', methods: ['POST'])]
    public function delete(Request $request, PlayersTeam $playersTeam, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$playersTeam->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($playersTeam);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_players_team_index');
    }
}
