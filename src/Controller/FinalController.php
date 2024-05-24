<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/final')]
class FinalController extends AbstractController
{
    #[Route('/', name: 'app_final_index')]
    public function index(): Response
    {
        return $this->render('frontend/final.html.twig');
    }
}