<?php

namespace App\Controller;

use App\Entity\Image;
use App\Form\ImageType;
use App\Repository\ImageRepository;
use App\Repository\MembreRepository;
use App\Utility\Utility;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/image')]
class ImageController extends AbstractController
{
    public function __construct(private Utility $utility)
    {
    }

    #[Route('/', name: 'app_image_index', methods: ['GET'])]
    public function index(ImageRepository $imageRepository): Response
    {
        return $this->render('image/index.html.twig', [
            'images' => $imageRepository->findAll(),
        ]);
    }

    #[Route('/{membre}-new', name: 'app_image_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, $membre, MembreRepository $membreRepository): Response
    {
        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $membreEntity = $membreRepository->findOneBy(['id' => $membre]);
            $image->setMembre($membreEntity); //dd($image);
            $entityManager->persist($image);
            $entityManager->flush();

            $this->utility->addFlag($request->getSession()->get('encours'), 3);

            return $this->redirectToRoute('app_fonctionnement_new', [
                'image' => $image->getId()
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->render('image/new.html.twig', [
            'image' => $image,
            'form' => $form,
            'membre_id' => $membre
        ]);
    }

    #[Route('/{id}', name: 'app_image_show', methods: ['GET'])]
    public function show(Image $image): Response
    {
        return $this->render('image/show.html.twig', [
            'image' => $image,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_image_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Image $image, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_fonctionnement_new', [
                'image' => $image->getId()
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->render('image/edit.html.twig', [
            'image' => $image,
            'form' => $form,
            'membre_id' => $image->getMembre()->getId()
        ]);
    }

    #[Route('/{id}', name: 'app_image_delete', methods: ['POST'])]
    public function delete(Request $request, Image $image, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$image->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($image);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_image_index', [], Response::HTTP_SEE_OTHER);
    }
}
