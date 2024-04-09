<?php

declare(strict_types=1);

namespace App\Retention\Users\Application\Command;

use App\Shared\Domain\Bus\Command\Command;

final readonly class CreateRetentionUserCommand implements Command
{
    public function __construct(
        private string $id,
        private string $name,
        private string $email,
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
