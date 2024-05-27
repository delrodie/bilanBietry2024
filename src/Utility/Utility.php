<?php

namespace App\Utility;

use App\Repository\ActiviteRepository;
use App\Repository\ExperienceRepository;
use App\Repository\FonctionnementRepository;
use App\Repository\ImageRepository;
use App\Repository\MembreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class Utility
{
    private $session;
    public function __construct(
        private UrlGeneratorInterface $urlGenerator,
        private ExperienceRepository $experienceRepository,
        private ActiviteRepository $activiteRepository,
//        private FonctionnementRepository $fonctionnementRepository,
        private MembreRepository $membreRepository,
        private ImageRepository $imageRepository,
        private RequestStack $requestStack,
        private EntityManagerInterface $entityManager
    )
    {
    }

    public function newSession($experience)
    {
        $this->requestStack->getSession()->set('encours', $experience);

        return true;
    }


    /**
     * @return string
     */
    public function currentSession(): string
    {
        $session = $this->requestStack->getSession()->get('encours');
        if (!$session) return false;

        $experience = $this->experienceRepository->findOneBy(['id' => $session]);

        if (!$experience) return false;

        $experienceID = $experience->getId();
        $flag = $experience->getFlag();
        $routes = [
//            'app_home',
            'app_activite_new',
            'app_membre_new',
            'app_image_new',
            'app_fonctionnement_new',
        ];

        $parameters = [];
        $routeIndex = $flag ?: 0;

        if ($flag === 1) $entity = $this->activiteRepository->findOneBy(['experience' => $experienceID]);
        elseif ($flag === 2) $entity = $this->membreRepository->getOneByExperience($experienceID);
        elseif ($flag === 3) $entity = $this->imageRepository->getOneByExperience($experienceID);

        if (isset($entity)) {
            $entityName =[
                'home',
                'activite',
                'membre',
                'image'
            ] ;
            $parameters = [(string)($entityName[$flag]) => $entity->getId()];
        }
//        dd($parameters);
        return $this->urlGenerator->generate($routes[$routeIndex], $parameters);
    }

    public function addFlag($session, int $flag): bool
    {
//        if (!$session) return false;

        $entity = $this->experienceRepository->findOneBy(['id' => $session]);

        $entity->setFlag($flag);
        $this->entityManager->flush();

        return true;
    }

    public function getStatistiques()
    {
        $statistiques = [];
    }
}