<?php

namespace App\Controller;

use App\Entity\GoalsAssists;
use App\Form\GoalsAssistsType;
use App\Repository\GoalsAssistsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/goals/assists')]
final class GoalsAssistsController extends AbstractController{
    #[Route(name: 'app_goals_assists_index', methods: ['GET'])]
    public function index(GoalsAssistsRepository $goalsAssistsRepository): Response
    {
        return $this->render('admin/goals_assists/index.html.twig', [
            'goals_assists' => $goalsAssistsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_goals_assists_new', methods: ['GET', 'POST'])]
    public function new(Request $request, GoalsAssistsRepository $goalsAssistsRepository): Response
    {
        $goalsAssist = new GoalsAssists();
        $form = $this->createForm(GoalsAssistsType::class, $goalsAssist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $goalsAssistsRepository->save($goalsAssist, true);
            return $this->redirectToRoute('app_goals_assists_index');
        }

        return $this->render('admin/goals_assists/new.html.twig', [
            'goals_assist' => $goalsAssist,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_goals_assists_show', methods: ['GET'])]
    public function show(GoalsAssists $goalsAssist): Response
    {
        return $this->render('admin/goals_assists/show.html.twig', [
            'goals_assist' => $goalsAssist,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_goals_assists_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, GoalsAssists $goalsAssist, GoalsAssistsRepository $goalsAssistsRepository): Response
    {
        $form = $this->createForm(GoalsAssistsType::class, $goalsAssist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $goalsAssistsRepository->save($goalsAssist, true);
            return $this->redirectToRoute('app_goals_assists_index');
        }

        return $this->render('admin/goals_assists/edit.html.twig', [
            'goals_assist' => $goalsAssist,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_goals_assists_delete', methods: ['POST'])]
    public function delete(Request $request, GoalsAssists $goalsAssist, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$goalsAssist->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($goalsAssist);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_goals_assists_index');
    }
}
