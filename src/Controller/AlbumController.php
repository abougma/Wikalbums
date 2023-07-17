<?php

namespace App\Controller;

use App\Entity\Album;
use App\Form\AlbumType;
use App\Repository\AlbumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlbumController extends AbstractController
{
    #[Route('/album', name: 'app_album')]
    public function create(Request $request, AlbumRepository $albumRepository): Response
    {
        $album = new Album();
        $form = $this->createForm(AlbumType::class, $album);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $albumRepository->save($album, true);
            $this->addFlash('success', message: 'Album ajouter avec succes !');
            return $this->redirectToRoute('app_album');
        }

        return $this->render('album/create.html.twig', [
            'form' => $form,
        ]);
    }
}
