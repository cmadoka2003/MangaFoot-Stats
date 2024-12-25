<?php

namespace App\Controller;

use App\Entity\Overalls;
use App\Form\OverallsType;
use App\Repository\OverallRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/overalls')]
final class OverallsController extends AbstractController{
    #[Route(name: 'app_overalls_index', methods: ['GET'])]
    public function index(OverallRepository $overallRepository): Response
    {
        return $this->render('admin/overalls/index.html.twig', [
            'overalls' => $overallRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_overalls_new', methods: ['GET', 'POST'])]
    public function new(Request $request, OverallRepository $overallRepository): Response
    {
        $overall = new Overalls();
        $form = $this->createForm(OverallsType::class, $overall);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $overallRepository->save($overall, true);
            return $this->redirectToRoute('app_overalls_index');
        }

        return $this->render('admin/overalls/new.html.twig', [
            'overall' => $overall,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_overalls_show', methods: ['GET'])]
    public function show(Overalls $overall): Response
    {
        return $this->render('admin/overalls/show.html.twig', [
            'overall' => $overall,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_overalls_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Overalls $overall, OverallRepository $overallRepository): Response
    {
        $form = $this->createForm(OverallsType::class, $overall);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $overallRepository->save($overall, true);
            return $this->redirectToRoute('app_overalls_index');
        }

        return $this->render('admin/overalls/edit.html.twig', [
            'overall' => $overall,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_overalls_delete', methods: ['POST'])]
    public function delete(Request $request, Overalls $overall, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$overall->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($overall);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_overalls_index');
    }
}
