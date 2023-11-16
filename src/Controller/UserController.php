<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $array = ["ROLE_STUDENT"]; 
            $user->setRoles($array); 
            $entityManager->persist($user);
            $entityManager->flush();
            
            // rediriger vers une page de confirmation, par exemple :
            return $this->redirectToRoute('app_login');
        }
    
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'user'=> $this->getUser(),
            'form' => $form->createView()
        ]);
    }



    
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_prof');
        }
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('prof/authentification.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }


    #[Route('/logout', name: 'app_logout')]
    public function logout()
    {

    }
}
