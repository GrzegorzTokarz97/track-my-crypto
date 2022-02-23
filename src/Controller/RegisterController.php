<?php

declare(strict_types=1);

namespace App\Controller;

use App\Document\User;
use App\Form\Type\RegistrationType;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    #[Route('/register', name: 'register')]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, DocumentManager $documentManager): Response
    {
        $form = $this->createForm(RegistrationType::class)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = new User($form->get('username')->getData());

            $password = $passwordHasher->hashPassword(
                $user,
                $form->get('password')->getData()
            );

            $user->setPassword($password);

            $documentManager->persist($user);
            $documentManager->flush();
        }

        return $this->render('security/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
