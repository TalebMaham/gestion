<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OpportunityController extends AbstractController
{
    #[Route('/opportunity', name: 'app_opportunity')]
    public function index(): Response
    {
        return $this->render('opportunity/index.html.twig', [
            'controller_name' => 'OpportunityController',
        ]);
    }
}
