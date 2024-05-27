<?php

namespace App\Controller;

use App\Utility\Utility;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/final')]
class FinalController extends AbstractController
{
    public function __construct(private Utility $utility)
    {
    }

    #[Route('/', name: 'app_final_index')]
    public function index(): Response
    {
        $statistiques = $this->utility->getStatistiques();

        return
            $statistiques ?
                $this->render('frontend/final.html.twig',['score' => $statistiques]) :
                $this->redirectToRoute('app_home');

    }

}