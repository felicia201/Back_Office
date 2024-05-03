<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthPageController extends AbstractController
{
    #[Route('/', name: 'app_auth_page')]
    public function index(UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $superdmin = ["ROLE_SUPER_ADMIN", "ROLE_ADMIN", "ROLE_EDITOR", "ROLE_USER"];
        $admin = ["ROLE_ADMIN", "ROLE_EDITOR", "ROLE_USER"];
        $editor = ["ROLE_EDITOR", "ROLE_USER"];
        $user = [];

        // $user = $userRepository->find(id: 2);
        // $user->setRoles($admin);
        // $entityManager->flush();

        // if ($this->getUser())
        // {
        //     dd($this->getUser->getfirstName());
        // }

        return $this->render('auth_page/index.html.twig', [
            // 'controller_name' => 'AuthPageController',
        ]);
    }

    #[Route('/super-admin/dashbord', name: 'app_super_admin_dashbord')]
    public function dashboard(): Response
    {
        dd('Connecté en tant que super admin');
    }

    #[Route('/user/dashbord', name: 'app_super_admin_dashbord')]
    public function userdashboard(): Response
    {
        dd('Connecté en tant que user');
    }
}

