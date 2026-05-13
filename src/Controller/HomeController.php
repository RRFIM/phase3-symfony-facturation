<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;


final class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(#[CurrentUser()] User $user): Response
    {
        $name = $user->getNom();
        $lastname = $user->getPrenom();
        $email = $user->getEmail();
        
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'name' => $name,
            'lastname' => $lastname,
            'email' => $email,
        ]);
    }
}
