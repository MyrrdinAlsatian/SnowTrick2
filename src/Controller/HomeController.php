<?php

namespace App\Controller;

use App\Entity\Tricks;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
        if (!is_numeric($request->query->get("page", 1)) or (int)$request->query->get("page", 1) <= 0) {
            $page = 1;
        } else {
            $page = (int)$request->query->get("page", 1);
        }

        
        $limit = 10; //we want 10 records per page

        $start = $limit * $page - $limit; //offset calculation (the start)
        $repo = $doctrine->getRepository(Tricks::class);

        $total = count($repo->findAll()); //
        $pages = ceil($total / $limit);
        // $tricks = $repo->findBy([], ['createdAt' => 'DESC'], 15, 0);
        $tricks = $repo->findBy([], [], $limit, $start);

        return $this->render('home/index.html.twig', [
            'titre' => 'SnowTricks',
            'slogan' => 'Grab ta place dans la communauté',
            'tricks' => $tricks,
            'page' => $page,
            'pages' => $pages,
            'limit' => $limit,

        ]);
    }
}
