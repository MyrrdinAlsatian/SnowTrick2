<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Image;
use App\Entity\Tricks;
use App\Entity\Video;
use App\Form\CommentType;
use App\Form\TricksType;
use App\Repository\CommentRepository;
use App\Repository\ImageRepository;
use App\Repository\TricksRepository;
use App\Service\FileUploader;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tricks')]
class TricksController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/', name: 'app_tricks_index', methods: ['GET'])]
    public function index(TricksRepository $tricksRepository): Response
    {
        return $this->render('tricks/index.html.twig', [
            'tricks' => $tricksRepository->findAll(),
        ]);
    }
    #[IsGranted('ROLE_USER')]
    #[Route('/new', name: 'app_tricks_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TricksRepository $tricksRepository, ImageRepository $imageRepository, FileUploader $fileUploader): Response
    {
        $trick = new Tricks();
        $form = $this->createForm(TricksType::class, $trick);
        $form->remove('updatedAt')
            ->remove('createdAt')
            ->remove('user');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trick->setUser($this->getUser());

            $ft_img = $form->get('feature_image')->getData();
            if ($ft_img) {
                $filepath = $fileUploader->upload($ft_img);
                $newFt_image = new Image();
                $newFt_image->setPath($filepath);
                $newFt_image->setFeature($trick);
                $imageRepository->save($newFt_image);
            }

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
            'image' => $trick->getFeatureImage()
        ]);
    }

    #[Route('/{slug}', name: 'app_tricks_show', methods: ['GET','POST'])]
    public function show(ManagerRegistry $doctrine, Tricks $trick, CommentRepository $commentsRepository, Request $request): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        // récupération de la figure
        $repo = $doctrine->getRepository(Tricks::class);
        $form->remove('createdAt')->remove('user')->remove('trick');
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setTrick($trick)->setCreatedAt(new \DateTimeImmutable())->setUser($this->getUser());
            $commentsRepository->save($comment, true);

            // return $this->redirectToRoute('app_comments_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tricks/show.html.twig', [
            'trick' => $trick,
            'images' => $trick->getImages(),
            'comments' => $trick->getComments(),
            'videos' => $trick->getVideos(),
            'image' => $trick->getFeatureImage(),
            'form' => $form,
            
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/{id}/edit', name: 'app_tricks_edit', methods: ['GET', 'POST'])]
    #[ParamConverter('id', class: Tricks::class, options:['mapping' => ['id' => 'id']])]
    public function edit(Request $request, FileUploader $fileUploader, Tricks $trick, TricksRepository $tricksRepository): Response
    {
        $form = $this->createForm(TricksType::class, $trick);
        $form->remove('updatedAt')
            ->remove('createdAt')
            ->remove('user');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ft_img= $form->get('feature_image')->getData();
            if($ft_img){
                $filepath = $fileUploader->upload($ft_img);
                $newFt_image = new Image();
                $newFt_image->setPath($filepath);
                $newFt_image->setFeature($trick);
            }

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
            
            $tricksRepository->update();
            $this->addFlash('Success', 'La figure à bien été mise à jour');

            return $this->redirectToRoute('app_tricks_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tricks/edit.html.twig', [
            'trick' => $trick,
            'images' => $trick->getImages(),
            'form' => $form,
            'image'=> $trick->getFeatureImage()
        ]);
    }
    #[IsGranted('ROLE_USER')]
    #[Route('/{id}', name: 'app_tricks_delete', methods: ['POST'])]
    public function delete(Request $request, Tricks $trick, TricksRepository $tricksRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $trick->getId(), $request->request->get('_token'))) {
            $tricksRepository->remove($trick, true);
        }
        $this->addFlash('Success', 'La figure à bien été supprimer');
        return $this->redirectToRoute('app_tricks_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/delete/image/{id}', name: 'app_image_delete')]
    public function deleteImage(Request $request, Image $image, ImageRepository $entityManager): Response
    {
        unlink($this->getParameter('medias_directory') . '/' . $image->getPath());
        $entityManager->remove($image, true);
        $route = $request->headers->get('referer');
        $this->addFlash('success', 'L\image à bien été supprimer');
        return $this->redirect($route);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/unset/image/{id}', name: 'app_ftimage_delete')]
    #[ParamConverter('id', class: Image::class, options:['mapping' => ['id' => 'id']])]
    public function unsetImage(Request $request, Image $image, ImageRepository $entityManager): Response
    {
        // unlink($this->getParameter('medias_directory') . '/' . $image->getPath());
        // $trick = $image->getFeature();
        $image->setFeature(null);
        $entityManager->save($image, true);
        $route = $request->headers->get('referer');
        $this->addFlash('success', 'L\'image à bien été supprimer');
        return $this->redirect($route);
    }
}
