<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class RegisterController extends AbstractController {
    #[Route('/api/register', name: 'api_register', methods: ['POST'])]
    public function register(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $em
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        // Verifier si les donnés ont bien été saisie
        if (!isset($data['email'], $data['password'], $data['name'], $data['first_name'])) {
            return new JsonResponse(['error' => 'Missing fields'], 400);
        }

        // Verifier email si déja existant
        $existingUser = $em->getRepository(User::class)->findOneBy(['email' => $data['email']]);
            if ($existingUser) {
            return new JsonResponse(['error' => 'Email already in use'], 409);
            }

        $user = new User();
        $user->setEmail($data['email']);
        $user->setName($data['name']);
        $user->setFirstName($data['first_name']);
        $user->setPassword($passwordHasher->hashPassword($user, $data['password']));
        $user->setRoles(['ROLE_USER']); // par défaut

        $em->persist($user);
        $em->flush();

        return new JsonResponse([
            'status' => 'User created',
            'id' => $user->getId(),
            'name' => $user->getName()
        ], 201);
    }
}