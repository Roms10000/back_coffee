<?php
namespace App\EventListener;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsEntityListener(event: Events::prePersist, method: 'hashPassword', entity: User::class)] //avant d’insérer un nouvel utilisateur.
#[AsEntityListener(event: Events::preUpdate, method: 'hashPassword', entity: User::class)] //avant de modifier un utilisateur.
class UserPasswordListener
{
    public function __construct(private UserPasswordHasherInterface $hasher) {}

    public function hashPassword(User $user, LifecycleEventArgs $args): void
    {
        if ($user->getPassword()) {
            $user->setPassword(
                $this->hasher->hashPassword($user, $user->getPassword())
            );
        }
    }
}