<?php

namespace App\Controller;

use App\Repository\ActiviteRepository;
use App\Repository\ExperienceRepository;
use App\Repository\FonctionnementRepository;
use App\Repository\ImageRepository;
use App\Repository\MembreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dashboard')]
class DashboardController extends AbstractController
{
    public function __construct(
        private ExperienceRepository $experienceRepository,
        private ActiviteRepository $activiteRepository,
        private MembreRepository $membreRepository,
        private ImageRepository $imageRepository,
        private FonctionnementRepository $fonctionnementRepository
    )
    {
    }

    #[Route('/', name:"app_dashboard")]
    public function index()
    {
        return $this->render('frontend/dashboard.html.twig',[
            'experiences' => $this->experienceRepository->findAll(),
            'activites' => $this->activiteRepository->findAll(),
            'effectifs' => $this->membreRepository->findAll(),
            'images' => $this->imageRepository->findAll(),
            'fonctionnements' => $this->fonctionnementRepository->findAll()
        ]);
    }
}