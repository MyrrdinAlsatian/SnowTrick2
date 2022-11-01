<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Tricks;
use App\Entity\Video;
use App\Form\TricksType;
use App\Repository\TricksRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tricks')]
class TricksController extends AbstractController
{
    #[Route('/', name: 'app_tricks_index', methods: ['GET'])]
    public function index(TricksRepository $tricksRepository): Response
    {
        return $this->render('tricks/index.html.twig', [
            'tricks' => $tricksRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tricks_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TricksRepository $tricksRepository, FileUploader $fileUploader): Response
    {
        $trick = new Tricks();
        $form = $this->createForm(TricksType::class, $trick);
        $form->remove('updatedAt')
            ->remove('createdAt')
            ->remove('user');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trick->setUser($this->getUser());

            $images = $form->get('images')->getData();

            if ($images) {
                foreach ($images as $image) {
                    $filepath = $fileUploader->upload($image);
                    $newimage = new Image();
                    $newimage->setPath($filepath);
                    $trick->addImage($newimage);
                }
            }

            $videos = $form->get('videos')->getData();

            if ($videos) {
                foreach ($videos as $video) {

                    $video->addTrick($trick);
                }
            }


            $tricksRepository->save($trick, true);
            $this->addFlash('Success', 'La figure à bien été ajouter');

            return $this->redirectToRoute('app_tricks_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tricks/new.html.twig', [
            'trick' => $trick,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tricks_show', methods: ['GET'])]
    public function show(Tricks $trick): Response
    {
        return $this->render('tricks/show.html.twig', [
            'trick' => $trick,
            'images' => $trick->getImages(),
            'comments' => $trick->getComments(),
            'videos' => $trick->getVideos(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tricks_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tricks $trick, TricksRepository $tricksRepository): Response
    {
        $form = $this->createForm(TricksType::class, $trick);
        $form->remove('updatedAt')
            ->remove('createdAt')
            ->remove('user');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tricksRepository->update();
            $this->addFlash('Success', 'La figure à bien été mise à jour');

            return $this->redirectToRoute('app_tricks_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tricks/edit.html.twig', [
            'trick' => $trick,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tricks_delete', methods: ['POST'])]
    public function delete(Request $request, Tricks $trick, TricksRepository $tricksRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $trick->getId(), $request->request->get('_token'))) {
            $tricksRepository->remove($trick, true);
        }
        $this->addFlash('Success', 'La figure à bien été supprimer');
        return $this->redirectToRoute('app_tricks_index', [], Response::HTTP_SEE_OTHER);
    }
}
