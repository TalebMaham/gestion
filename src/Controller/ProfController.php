<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\MatiereRepository;
use App\Repository\NoteRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route(path: '/prof')]
class ProfController extends AbstractController
{
    #[Route('/eleves', name: 'app_prof')]
 
    public function index(Request $request, UserRepository $userRepository, NoteRepository $noteRepository, MatiereRepository $matiereRepository): Response
    {
        $eleves = $userRepository->findAllStudents(); 
        $notes = $noteRepository->findAll(); 
        $matiers = $matiereRepository->findAll(); 
  

        return $this->render('prof/index.html.twig', [
            'controller_name' => 'ProfController',
            'eleves' => $eleves,
            'notes' => $notes,
            'matieres' => $matiers 
        ]);
    }


    #[Route( path : '_searchSelect', name: 'app_prof_id')]
    public function student(Request $request, UserRepository $userRepository): Response
    {
        $output = [];
        $search = $request->get('q'); 
        $etudiants = $userRepository->search($search); 
  
           
        return new JsonResponse($etudiants[0]); 
    }


    #[Route( path : '_presence', name: 'prise_presence')]
    public function presence(Request $request, UserRepository $userRepository): Response
    {
        $output = [];
        $eleve_id = $request->get('eleve_id');
        $is_present = $request->get('is_present');
        $etudiants = $userRepository->findBy(['id' => $eleve_id]);
         

        if($is_present)
        {
            $status = "Present";
            $etudiants[0]->setPresent(true); 
            return $this->json([
                'success' => true,
                'status' => $status
            ]);
        }

       
          $status = "Absent";
          $etudiants[0]->setPresent(false); 
          return $this->json([
            'success' => true,
            'status' => $status
        ]);
    }
}
