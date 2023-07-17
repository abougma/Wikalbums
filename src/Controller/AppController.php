<?php

namespace App\Controller;

use App\Repository\AlbumRepository;
use App\Repository\ArtistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    #[Route('/', name: 'app_app')]
    public function index(ArtistRepository $artistRepository): Response
    {
        $artists = $artistRepository->findAll();
        return $this->render('app/index.html.twig', [
            'artists' => $artists,
        ]);
    }
}
