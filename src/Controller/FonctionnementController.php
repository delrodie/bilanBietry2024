<?php

namespace App\Controller;

use App\Entity\Fonctionnement;
use App\Form\FonctionnementType;
use App\Repository\FonctionnementRepository;
use App\Repository\ImageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/fonctionnement')]
class FonctionnementController extends AbstractController
{
    #[Route('/', name: 'app_fonctionnement_index', methods: ['GET'])]
    public function index(FonctionnementRepository $fonctionnementRepository): Response
    {
        return $this->render('fonctionnement/index.html.twig', [
            'fonctionnements' => $fonctionnementRepository->findAll(),
        ]);
    }

    #[Route('/{image}-new', name: 'app_fonctionnement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, $image, ImageRepository $imageRepository): Response
    {
        $fonctionnement = new Fonctionnement();
        $form = $this->createForm(FonctionnementType::class, $fonctionnement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageEntity = $imageRepository->findOneBy(['id' => $image]);
            $fonctionnement->setImage($imageEntity); //dd($fonctionnement);
            $entityManager->persist($fonctionnement);
            $entityManager->flush();

            return $this->redirectToRoute('app_final_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('fonctionnement/new.html.twig', [
            'fonctionnement' => $fonctionnement,
            'form' => $form,
            'image_id' => $image
        ]);
    }

    #[Route('/{id}', name: 'app_fonctionnement_show', methods: ['GET'])]
    public function show(Fonctionnement $fonctionnement): Response
    {
        return $this->render('fonctionnement/show.html.twig', [
            'fonctionnement' => $fonctionnement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_fonctionnement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Fonctionnement $fonctionnement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FonctionnementType::class, $fonctionnement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_fonctionnement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('fonctionnement/edit.html.twig', [
            'fonctionnement' => $fonctionnement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fonctionnement_delete', methods: ['POST'])]
    public function delete(Request $request, Fonctionnement $fonctionnement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fonctionnement->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($fonctionnement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_fonctionnement_index', [], Response::HTTP_SEE_OTHER);
    }
}
