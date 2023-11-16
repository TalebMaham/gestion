<?php

namespace App\Controller;


use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User; 
use App\Entity\Opportunity; 
use App\Entity\Projet; 
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ProjetType;
use Doctrine\ORM\Mapping as ORM;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Security;


#[Route(path: '/prof')]
class ProfController extends AbstractController
{
    #[Route('/eleves', name: 'app_prof')]
 
    public function index(Request $request, UserRepository $userRepository,EntityManagerInterface $entityManager): Response
    {
        
         // Vérifiez si l'utilisateur est authentifié
         if ($this->isGranted('ROLE_CLIENT')) {
            // Redirigez vers la page de connexion
            $projets = $entityManager->getRepository(Projet::class)->findAll();

            return $this->render('prof/index.html.twig', ["projets"=> $projets]);
        }
        // Vérifiez si l'utilisateur est authentifié
        if ($this->isGranted('ROLE_MANAGER')) {
        
        $projets = $entityManager->getRepository(Projet::class)->findAll();

        return $this->render('prof/index.html.twig', ["projets"=> $projets]);
        
    }
        return $this->redirectToRoute('app_login');
    }



 /**
     * @Route("/choisir", name="choisir")
     */
    public function analysesAction(Request $request): JsonResponse
    {
        // Votre logique pour la page d'analyses ici
        $data = [
            'message' => "Merci pour votre choix, l'application est actuellemnt en etat de productions"
        
        ];
        
        return $this->json($data);
    }


     /**
     * @Route("/mon_liste", name="mon_liste")
     */
    public function monListe(Request $request): Response
    {
        $user = $this->getUser();
        $projets = $user->getProjets(); 
        return $this->render('prof/client_projects_list.html.twig', ["projets" => $projets]);
    }


     /**
     * @Route("/opportunity/{id}", name="opportunity")
     */
    public function ajouterAnalyse(Request $request, EntityManagerInterface $entityManager, $id): Response
    {
        $opportunity = $entityManager->getRepository(Opportunity::class)->find($id);

        if (!$opportunity) {
            throw $this->createNotFoundException('Opportunity not found');
        }

        return $this->render('prof/opportunity.html.twig', [
            'opportunity' => $opportunity,
        ]);
    }

      /**
     * @Route("/projet/{id}", name="projet")
     */
    public function projet(Request $request, EntityManagerInterface $entityManager, $id): Response
    {
        $projet = $entityManager->getRepository(Projet::class)->find($id);

        if (!$projet) {
            throw $this->createNotFoundException('Projet not found');
        }

        return $this->render('prof/project.html.twig', [
            'projet' => $projet,
        ]);
    }  
    
    
    
    /**
     * @Route("/opportunity-list", name="opportunity_list")
     *  @IsGranted("ROLE_MANAGER")
     */
    public function listOpportunities(EntityManagerInterface $entityManager): Response
    {
       
        $opportunities = $entityManager->getRepository(Opportunity::class)->findAll();

        return $this->render('prof/list_of_available_opportunities.html.twig', [
            'opportunities' => $opportunities,
        ]);
    }


     /**
     * @Route("/projet_list", name="projet_list")
     */
    public function listProjet(EntityManagerInterface $entityManager): Response
    {
       
        $projets = $entityManager->getRepository(Projet::class)->findAll();

        return $this->render('prof/list_of_available_projects.html.twig', [
            'projets' => $projets,
        ]);
    }

    /**
     * @Route("/new-project", name="new_project")
     */
    public function nouveauProjet(Request $request, EntityManagerInterface $entityManager)
    {
        $projet = new Projet();
        $form = $this->createForm(ProjetType::class, $projet);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser(); // Récupérer l'utilisateur connecté
            $projet->setUser($user);   // Assigner l'utilisateur au projet
            $entityManager->persist($projet);
            $entityManager->flush();
            
            // Rediriger vers une page après l'enregistrement
            return $this->redirectToRoute('app_prof'); // Remplacez 'app_prof' par la route souhaitée
        }
        
        return $this->render('prof/project_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/opportunities/{userId}", name="opportunities_for_user")
    */
    public function opportunitiesForUser($userId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($userId);

        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }

        $userOpportunities = $user->getOpportunities();

        
    }


    
    /**
     * @Route("/add-project/{id}", name="add_project")
    */
    public function ajouterProjet (Request $request, Projet $projet, EntityManagerInterface $entityManager) : Response
    {
       
        $user = $this->getUser(); // Récupérer l'utilisateur connecté
        $projet->setUser($user);   // Assigner l'utilisateur au projet
        $user->addProjet($projet); 
        $projets = $user->getProjets(); 
        $entityManager->persist($projet);
        $entityManager->persist($user);
        $entityManager->flush();
        return $this->render('prof/client_projects_list.html.twig', ["projets" => $projets]);
        
    }

   /**
     * @Route("/associate-opportunity/{projetId}/{opportuniteId}", name="associate_opportunity")
     */
    public function associerOpportunite(Request $request, $projetId ,$opportuniteId, EntityManagerInterface $entityManager)
    {      

        // Récupérer les entités à partir de leurs IDs
        $projet = $entityManager->getRepository(Projet::class)->find($projetId);
        $opportunite = $entityManager->getRepository(Opportunity::class)->find($opportuniteId);
        if (!$opportunite) {
            throw $this->createNotFoundException('Opportunité non trouvée.');
        }
        if (!$projet) {
            throw $this->createNotFoundException('Projet non trouvé.');
        }
        

        // Associer l'opportunité au projet
        $projet->addOpportunity($opportunite);

        $entityManager->flush();

        return $this->redirectToRoute('mon_liste');
    }


    /**
     * @Route("/projets-ajax", name="projets_ajax")
     */
    public function projetsAjax(EntityManagerInterface $entityManager)
    {
        $projets = $entityManager->getRepository(Projet::class)->findAll();

        $projetsArray = [];
        foreach ($projets as $projet) {
            $projetsArray[] = [
                'id' => $projet->getId(),
                'nom' => $projet->getTitre(),
            ];
        }
        
        return new JsonResponse($projetsArray);
    }


       /**
     * @Route("associate-opportunity-show/{opportunityId}", name="associate_opportunity_show")
     */
    public function associerOpportuniteShow(Request $request, $opportunityId, EntityManagerInterface $entityManager)
    {
        $selectedId = 0;
        $opportunity = $entityManager->getRepository(Opportunity::class)->find($opportunityId);
        return $this->render('prof/associate_opportunity.html.twig', ["opportunity" => $opportunity, "projetId"=>$selectedId]);
    }
    

}
