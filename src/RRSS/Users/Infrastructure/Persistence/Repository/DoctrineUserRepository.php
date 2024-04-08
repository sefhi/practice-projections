<?php

declare(strict_types=1);

namespace App\RRSS\Users\Infrastructure\Persistence\Repository;

use App\RRSS\Users\Domain\User;
use App\RRSS\Users\Domain\UserRepository;
use App\Shared\Infrastructure\Persistence\Repository\DoctrineRepository;

class DoctrineUserRepository extends DoctrineRepository implements UserRepository
{
    public function save(User $user): void
    {
        $this->persist($user);
    }
}
