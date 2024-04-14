<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Repository\FormationRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FormationController extends AbstractController
{
    #[Route('/formation/{id}', name: 'app_formation')]
    public function index(EntityManagerInterface  $em, int $id ): Response
    {
        $formation=$em->getRepository(Formation::class)->find($id);
        if (null === $formation) {
            throw $this->createNotFoundException('Cette formation n\'existe pas');
        }
        
        return $this->render('formation/index.html.twig', [
            'controller_name' => 'FormationController',
            'formations'=>$formation->getName(),
        ]);
    }
    #[Route('/forma/{id}', name: 'app_formation')]
    public function indexx(FormationRepository  $em, int $id ): Response
    {
        $formation=$em->findOneById($id);
        if (null === $formation) {
            throw $this->createNotFoundException('Cette formation n\'existe pas');
        }
        
        return $this->render('formation/index.html.twig', [
            'controller_name' => 'FormationController',
            'formations'=>$formation->getName(),
        ]);
    }
#[Route ('/add',name : "add")]
public function add(EntityManagerInterface  $em):Response
{
    $form=new Formation();
$form->setName("Développement web");
$form->setDescription("description de formation");
$form->setPrice(500);
$em->persist($form);
$em->flush() ;
return new Response ("La formation a bien été ajoutée") ;}




}
