<?php

namespace App\Controller;

use App\Entity\Tuto;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
   
    public function index(EntityManagerInterface  $em ): Response
    {
        $Tutos=$em->getRepository(Tuto::class)->findAll();
    var_dump($Tutos);
        if (null === $Tutos) {
            throw $this->createNotFoundException('Cette formation n\'existe pas');
        }
        
       
        return $this->render('home/index.html.twig', [
            'Tutos'=>$Tutos,
        ]);
    }
}
