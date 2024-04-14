<?php

namespace App\Controller;

use App\Entity\Tuto;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TutoController extends AbstractController
{
    #[Route('/tuto', name: 'app_tuto')]
    public function index(): Response
    {
        return $this->render('tuto/index.html.twig', [
            'controller_name' => 'TutoController',
        ]);
    }
    #[Route('/tuto/{slug}', name: 'app_tuto_details')]
    public function view(EntityManagerInterface  $em, String $slug ): Response
    {
        $formation=$em->getRepository(Tuto::class)->findOneBySlug($slug);
        if (null === $formation) {
            throw $this->createNotFoundException('Cette formation n\'existe pas');
        }
        
        return $this->render('tuto/details.html.twig', [
           'tuto'=>$formation,
        ]);
    }
}
