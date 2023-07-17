<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Form\ArtistType;
use App\Repository\ArtistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtistController extends AbstractController
{
    #[Route('/artist', name: 'app_artist')]
    public function create(Request $request, ArtistRepository $artistRepository): Response
    {

        $artist = new Artist();
        $form =  $this->createForm(ArtistType::class, $artist);


        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $file = $form->get('imageFile')->getData();
            $extension = $file->guessExtension();
            if (!$extension){
                $extension = 'jpg';
            }
            $filename = rand(1, 99999).'.'.$extension;

            $file->move('img/artists/', $filename);

            $artist->setPhoto($filename);

            $artistRepository->save($artist, true);
            $this->addFlash('success', message: 'Artist bien enregistrer !');
            return $this->redirectToRoute('app_artist');
        }
        return $this->render('artist/create.html.twig', [
            'form' => $form,
        ]);
    }
    #[Route('/update/{id}', name: 'app_artist_update')]
    public function update(Artist $artist, Request $request, ArtistRepository $artistRepository): Response
    {


        $form =  $this->createForm(ArtistType::class, $artist);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            if($file = $form->get('imageFile')->getData())
            {
                $extension = $file->guessExtension();
                if (!$extension){
                    $extension = 'jpg';
                }
                $filename = rand(1, 99999).'.'.$extension;
                $file->move('img/artists/', $filename);

                $artist->setPhoto($filename);
            }

            $artistRepository->save($artist, true);
            $this->addFlash('success', message: 'Artist bien enregistrer !');
            return $this->redirectToRoute('app_artist');
        }
        return $this->render('artist/update.html.twig', [
            'form' => $form,
        ]);
    }
//Pour voir l'artiste
    #[Route('/artist/{id}', name: 'app_artist_show')]
    public function show(Artist $artist): Response
    {
        return $this->render('artist/show.html.twig',[
            'artist' => $artist
        ]);
    }


//Pour la suppression d'un artiste
    #[Route('/delete/{id}', name: 'app_artist_delete')]
    public function delete(Artist $artist, ArtistRepository $artistRepository): Response
    {
        $artistRepository->remove($artist, true);
        $this->addFlash('danger', message: 'Artist supprimer');
        return $this->redirectToRoute('app_app');
    }
}

