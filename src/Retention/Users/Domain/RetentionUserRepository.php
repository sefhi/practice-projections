<?php

declare(strict_types=1);

namespace App\Retention\Users\Domain;

use Ramsey\Uuid\UuidInterface;

interface RetentionUserRepository
{
    public function save(RetentionUser $user): void;

    public function findById(UuidInterface $id): ?RetentionUser;
}
