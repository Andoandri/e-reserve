<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\RegisterType;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterController extends AbstractController
{

    private $hashPassword;


    public function __construct(UserPasswordHasherInterface $hashPassword)
    {
        $this->hashPassword = $hashPassword;
    }

    #[Route('/register', name: 'app_register')]
    public function index(Request $request, UserRepository $userRepo): Response
    {
        $user = new User();
        $user->setRoles(array('Role_user'));

        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setPassword($this->hashPassword->hashPassword($user, $user->getPassword()));

            $userRepo->save($user, true);

            return $this->redirectToRoute('app_home');
        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
