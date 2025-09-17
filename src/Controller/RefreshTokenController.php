<?php

namespace App\Controller;

use App\Dto\RefreshTokenOutput;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Cookie;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class RefreshTokenController extends AbstractController
{
    private JWTTokenManagerInterface $jwtManager;
    private UserProviderInterface $userProvider;

    public function __construct(JWTTokenManagerInterface $jwtManager, UserProviderInterface $userProvider)
    {
        $this->jwtManager = $jwtManager;
        $this->userProvider = $userProvider;
    }

    public function __invoke(Request $request): RefreshTokenOutput
    {
        $refreshToken = $request->cookies->get('refreshToken');

        if (!$refreshToken) {
            throw $this->createAccessDeniedException('Refresh token manquant');
        }

        $payload = $this->jwtManager->decode($refreshToken);
        $user = $this->userProvider->loadUserByIdentifier($payload['email'] ?? null);

        if (!$user) {
            throw $this->createNotFoundException('Utilisateur introuvable');
        }

        $newAccessToken = $this->jwtManager->create($user);
        $newRefreshToken = $this->jwtManager->create($user);

        // Mettre le refresh token dans un cookie
        $cookie = Cookie::create(
            'refreshToken',
            $newRefreshToken,
            (new \DateTime('+7 days'))->getTimestamp(),
            '/',
            null,
            true,   // secure
            true,   // httpOnly
            false,
            'Strict'
        );

        $response = new RefreshTokenOutput();
        $response->accessToken = $newAccessToken;

        // Utiliser un EventListener pour ajouter le cookie à la réponse API Platform
        $request->attributes->set('_refreshTokenCookie', $cookie);

        return $response;
    }
}