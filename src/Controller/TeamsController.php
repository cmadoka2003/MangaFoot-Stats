<?php

namespace App\Controller;

use App\Entity\Teams;
use App\Form\TeamsType;
use App\Repository\TeamsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/teams')]
final class TeamsController extends AbstractController{
    #[Route(name: 'app_teams_index', methods: ['GET'])]
    public function index(TeamsRepository $teamsRepository): Response
    {
        return $this->render('admin/teams/index.html.twig', [
            'teams' => $teamsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_teams_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TeamsRepository $teamsRepository, SluggerInterface $slugger, #[Autowire('%kernel.project_dir%/public/uploads/logos')] string $avatarDirectory): Response
    {
        $team = new Teams();
        $form = $this->createForm(TeamsType::class, $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $logofile = $form->get('logo')->getData();
            
            if($logofile)
            {
                $lienOriginel = pathinfo($logofile->getClientOriginalName(), PATHINFO_FILENAME);

                $lienSecurisee = $slugger->slug($lienOriginel);

                $nouveauLien = $lienSecurisee.'-'.uniqid().'.'.$logofile->guessExtension();

                try {
                    $logofile->move($avatarDirectory, $nouveauLien);
                } catch (FileException $e) {}

                $team->setLogo($nouveauLien);
            }

            $teamsRepository->save($team, true);
            return $this->redirectToRoute('app_teams_index');
        }

        return $this->render('admin/teams/new.html.twig', [
            'team' => $team,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_teams_show', methods: ['GET'])]
    public function show(Teams $team): Response
    {
        return $this->render('admin/teams/show.html.twig', [
            'team' => $team,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_teams_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Teams $team, TeamsRepository $teamsRepository, SluggerInterface $slugger, #[Autowire('%kernel.project_dir%/public/uploads/logos')] string $avatarDirectory): Response
    {
        $form = $this->createForm(TeamsType::class, $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $logofile = $form->get('logo')->getData();
            
            if($logofile)
            {
                $lienOriginel = pathinfo($logofile->getClientOriginalName(), PATHINFO_FILENAME);

                $lienSecurisee = $slugger->slug($lienOriginel);

                $nouveauLien = $lienSecurisee.'-'.uniqid().'.'.$logofile->guessExtension();

                try {
                    $logofile->move($avatarDirectory, $nouveauLien);
                } catch (FileException $e) {}

                $team->setLogo($nouveauLien);
            }
            $teamsRepository->save($team, true);
            return $this->redirectToRoute('app_teams_index');
        }

        return $this->render('admin/teams/edit.html.twig', [
            'team' => $team,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_teams_delete', methods: ['POST'])]
    public function delete(Request $request, Teams $team, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$team->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($team);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_teams_index');
    }
}
