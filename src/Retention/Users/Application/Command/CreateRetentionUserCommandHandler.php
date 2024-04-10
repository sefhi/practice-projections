<?php

declare(strict_types=1);

namespace App\Retention\Users\Application\Command;

use App\Retention\Users\Domain\RetentionUser;
use App\Retention\Users\Domain\RetentionUserRepository;
use App\Shared\Domain\Bus\Command\CommandHandler;
use Ramsey\Uuid\Uuid;

class CreateRetentionUserCommandHandler implements CommandHandler
{
    public function __construct(
        private RetentionUserRepository $retentionUserRepository
    ) {
    }

    public function __invoke(CreateRetentionUserCommand $command): void
    {
        if (null !== $this->retentionUserRepository->findById(Uuid::fromString($command->getId()))) {
            return;
        }

        $this->retentionUserRepository->save(
            RetentionUser::create(
                $command->getId(),
                $command->getName(),
                $command->getEmail(),
            )
        );
    }
}
