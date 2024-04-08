<?php

declare(strict_types=1);

namespace App\RRSS\Users\Domain;

interface UserRepository
{
    public function save(User $user): void;
}
