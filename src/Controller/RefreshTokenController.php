<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class RefreshTokenController extends AbstractController
{
    private $jwtManager;
    private $userProvider;

    public function __construct(JWTTokenManagerInterface $jwtManager, UserProviderInterface $userProvider)
    {
        $this->jwtManager = $jwtManager;
        $this->userProvider = $userProvider;
    }

    #[Route('/api/refresh', name: 'api_refresh', methods: ['POST'])]
    public function refresh(Request $request): JsonResponse
    {
        // Récupère le cookie refreshToken
        $refreshToken = $request->cookies->get('refreshToken');

        if (!$refreshToken) {
            return new JsonResponse(['message' => 'Refresh token manquant'], 401);
        }

        // Ici, tu peux vérifier le token avec JWT ou en BDD
        try {
            // Exemple de décodage simple (adapter selon ta config)
            $payload = $this->jwtManager->decode($refreshToken);

            // Récupère l'utilisateur correspondant
            $user = $this->userProvider->loadUserByUsername($payload['email']);

            // Génère un nouvel access token
            $newAccessToken = $this->jwtManager->create($user);

            return new JsonResponse(['accessToken' => $newAccessToken]);
        } catch (\Exception $e) {
            return new JsonResponse(['message' => 'Refresh token invalide'], 403);
        }
    }
}
