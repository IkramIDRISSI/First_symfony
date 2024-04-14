<?php

namespace App\Controller;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\SigninType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
class SignInController extends AbstractController
{
    #[Route('/sign/in', name: 'app_sign_in')]
    public function index(Request $request,EntityManagerInterface $em,UserPasswordHasherInterface $password): Response
    {
        $user=new User();
        $form =$this->createForm(SigninType::class, $user);
        $form=$form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $user=$form->getData();
            $plaintextPassword= $user->getPassword();
            $hashedPassword = $password->hashPassword(
                $user,
                $plaintextPassword
            );
            $user->setPassword($hashedPassword);
            //Enregistrement de l'util
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('sign_in/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
