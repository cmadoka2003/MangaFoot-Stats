<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ConnexionType;
use App\Form\InscriptionType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class AuthentificationController extends AbstractController
{
    #[Route('/', name: 'app_login')]
    public function connexion(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('profil');
        }
        // Récupère l'erreur de connexion, s'il y en a une
        $error = $authenticationUtils->getLastAuthenticationError();
        // Récupère le dernier email utilisé
        $lastUsername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(ConnexionType::class);

        return $this->render('connexion.html.twig', [
            'form' => $form->createView(),
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route('/inscription', name: 'inscription')]
    public function inscription(Request $req, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher)
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('profil');
        }

        $user = new User();

        $form = $this->createForm(InscriptionType::class, $user);

        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $verif = $userRepository->findOneBy(["email" => $user->getUserIdentifier()]);
            if ($verif) {
                $this->addFlash('compte-error', 'compte déjà existant');
                return $this->render('inscription.html.twig', ["form" => $form]);
            }
            $passwordhash = $passwordHasher->hashPassword($user, $user->getPassword());
            $user->setPassword($passwordhash);
            $userRepository->save($user, true);
            $this->addFlash('compte-creation', 'compte crée avec success');
            return $this->render('inscription.html.twig', ["form" => $form]);
        }
        return $this->render('inscription.html.twig', ["form" => $form]);
    }

    #[Route('/profil', name: 'profil')]
    public function profil()
    {
        if (!$this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('app_login');
        } 
        $nombre = 6;
        return $this->render('profil.html.twig', ["nombres" => $nombre]);
    }


    #[Route('/deconnexion', name: 'deconnexion')]
    public function deconnexion() {
        return $this->redirectToRoute('app_login');
    }
}
