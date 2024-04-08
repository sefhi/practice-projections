<?php

declare(strict_types=1);

namespace App\RRSS\Users\Application\Command;

use App\RRSS\Users\Domain\User;
use App\RRSS\Users\Domain\UserRepository;
use App\Shared\Domain\Bus\Command\CommandHandler;

final readonly class CreateUserCommandHandler implements CommandHandler
{
    public function __construct(
        private UserRepository $userRepository,
    ) {
    }

    public function __invoke(CreateUserCommand $command): void
    {
        $user = User::create(
            $command->id(),
            $command->name(),
            $command->email(),
            $command->profilePicture(),
        );

        $this->userRepository->save($user);
    }
}
