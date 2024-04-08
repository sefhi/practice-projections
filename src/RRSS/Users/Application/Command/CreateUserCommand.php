<?php

declare(strict_types=1);

namespace App\RRSS\Users\Application\Command;

use App\Shared\Domain\Bus\Command\Command;

final readonly class CreateUserCommand implements Command
{
    public function __construct(
        private string $id,
        private string $name,
        private string $email,
        private string $profilePicture
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function profilePicture(): string
    {
        return $this->profilePicture;
    }
}
