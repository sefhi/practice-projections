<?php

declare(strict_types=1);

namespace App\RRSS\Users\Infrastructure\Api\Dto;

use App\RRSS\Users\Application\Command\CreateUserCommand;

final readonly class CreateUserDto
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

    public function mapToCreateUserCommand(): CreateUserCommand
    {
        return new CreateUserCommand(
            $this->id,
            $this->name,
            $this->email,
            $this->profilePicture
        );
    }
}
