<?php
namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\Controller\RefreshTokenController;
use App\Dto\RefreshTokenOutput;

#[ApiResource(
    operations: [
        new Post(
            uriTemplate: '/refresh',
            controller: RefreshTokenController::class,
            name: 'api_refresh',
            output: RefreshTokenOutput::class
        )
    ],
    paginationEnabled: false
)]
class RefreshToken
{
    // vide, juste pour API Platform
}