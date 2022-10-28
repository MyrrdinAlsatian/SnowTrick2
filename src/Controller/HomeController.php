<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{   

    #[Route('/', name: 'app_home')]
    /**
     * Page d'accueil du site
     * Affiche les figures avec les 15 premières figures
     * 
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'titre' => 'SnowTricks',
            'slogan' => 'Grab ta place dans la communauté',
            'tricks' => []
        ]);
    }
}
