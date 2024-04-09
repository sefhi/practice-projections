<?php

declare(strict_types=1);

namespace App\Retention\Users\Infrastructure\Persistence\Repository;

use App\Retention\Users\Domain\RetentionUser;
use App\Retention\Users\Domain\RetentionUserRepository;
use App\Shared\Infrastructure\Persistence\Repository\DoctrineRepository;
use Ramsey\Uuid\UuidInterface;

final class DoctrineRetentionUserRepository extends DoctrineRepository implements RetentionUserRepository
{
    public function save(RetentionUser $user): void
    {
        $this->persist($user);
    }

    public function findById(UuidInterface $id): ?RetentionUser
    {
        $result = $this->repository(RetentionUser::class)->find($id);

        return $result instanceof RetentionUser ? $result : null;
    }
}
