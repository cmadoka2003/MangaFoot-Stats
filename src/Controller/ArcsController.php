<?php

namespace App\Controller;

use App\Entity\Arcs;
use App\Form\ArcsType;
use App\Repository\ArcsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/arcs')]
final class ArcsController extends AbstractController{
    #[Route(name: 'app_arcs_index', methods: ['GET'])]
    public function index(ArcsRepository $arcsRepository): Response
    {
        return $this->render('admin/arcs/index.html.twig', [
            'arcs' => $arcsRepository->findAll()
        ]);
    }

    #[Route('/new', name: 'app_arcs_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ArcsRepository $arcsRepository): Response
    {
        $arc = new Arcs();
        $form = $this->createForm(ArcsType::class, $arc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $arcsRepository->save($arc, true);
            return $this->redirectToRoute('app_arcs_index');
        }

        return $this->render('admin/arcs/new.html.twig', [
            'arc' => $arc,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_arcs_show', methods: ['GET'])]
    public function show(Arcs $arc): Response
    {
        return $this->render('admin/arcs/show.html.twig', [
            'arc' => $arc,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_arcs_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Arcs $arc, $id, ArcsRepository $arcsRepository): Response
    {
        $arc = $arcsRepository->find($id);
        $form = $this->createForm(ArcsType::class, $arc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $arcsRepository->save($arc, true);

            return $this->redirectToRoute('app_arcs_index');
        }

        return $this->render('admin/arcs/edit.html.twig', [
            'arc' => $arc,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_arcs_delete', methods: ['POST'])]
    public function delete(Request $request, Arcs $arc, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$arc->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($arc);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_arcs_index', [], Response::HTTP_SEE_OTHER);
    }
}
