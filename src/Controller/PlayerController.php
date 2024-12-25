<?php

namespace App\Controller;

use App\Entity\Player;
use App\Form\PlayerType;
use App\Repository\PlayerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/player')]
final class PlayerController extends AbstractController{
    #[Route(name: 'app_player_index', methods: ['GET'])]
    public function index(PlayerRepository $playerRepository): Response
    {
        return $this->render('admin/player/index.html.twig', [
            'players' => $playerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_player_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PlayerRepository $playerRepository, SluggerInterface $slugger, #[Autowire('%kernel.project_dir%/public/uploads/players')] string $avatarDirectory): Response
    {
        $player = new Player();
        $form = $this->createForm(PlayerType::class, $player);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $avatarfile = $form->get('avatar')->getData();
            
            if($avatarfile)
            {
                $lienOriginel = pathinfo($avatarfile->getClientOriginalName(), PATHINFO_FILENAME);

                $lienSecurisee = $slugger->slug($lienOriginel);

                $nouveauLien = $lienSecurisee.'-'.uniqid().'.'.$avatarfile->guessExtension();

                try {
                    $avatarfile->move($avatarDirectory, $nouveauLien);
                } catch (FileException $e) {}

                $player->setAvatar($nouveauLien);
            }
            $playerRepository->save($player, true);
            return $this->redirectToRoute('app_player_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/player/new.html.twig', [
            'player' => $player,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_player_show', methods: ['GET'])]
    public function show(Player $player): Response
    {
        return $this->render('admin/player/show.html.twig', [
            'player' => $player,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_player_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Player $player, PlayerRepository $playerRepository, SluggerInterface $slugger, #[Autowire('%kernel.project_dir%/public/uploads/players')] string $avatarDirectory): Response
    {
        $form = $this->createForm(PlayerType::class, $player);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $avatarfile = $form->get('avatar')->getData();
            
            if($avatarfile)
            {
                $lienOriginel = pathinfo($avatarfile->getClientOriginalName(), PATHINFO_FILENAME);

                $lienSecurisee = $slugger->slug($lienOriginel);

                $nouveauLien = $lienSecurisee.'-'.uniqid().'.'.$avatarfile->guessExtension();

                try {
                    $avatarfile->move($avatarDirectory, $nouveauLien);
                } catch (FileException $e) {}

                $player->setAvatar($nouveauLien);
            }
            $playerRepository->save($player, true);
            return $this->redirectToRoute('app_player_index');
        }

        return $this->render('admin/player/edit.html.twig', [
            'player' => $player,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_player_delete', methods: ['POST'])]
    public function delete(Request $request, Player $player, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$player->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($player);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_player_index');
    }
}
