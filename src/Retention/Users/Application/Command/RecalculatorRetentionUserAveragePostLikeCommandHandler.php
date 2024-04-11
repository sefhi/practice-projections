<?php

declare(strict_types=1);

namespace App\Retention\Users\Application\Command;

use App\Retention\Users\Domain\RetentionUserNotFoundException;
use App\Retention\Users\Domain\RetentionUserRepository;
use Ramsey\Uuid\Uuid;

final class RecalculatorRetentionUserAveragePostLikeCommandHandler
{
    public function __construct(
        private readonly RetentionUserRepository $retentionUserRepository
    ) {
    }

    public function __invoke(RecalculatorRetentionUserAveragePostLikeCommand $command): void
    {
        $retentionUser = $this->retentionUserRepository->findById(
            Uuid::fromString($command->userId())
        );

        if (null === $retentionUser) {
            throw new RetentionUserNotFoundException($command->userId());
        }

        $retentionUser->recalculatesAveragePostLikes();
        $this->retentionUserRepository->save($retentionUser);
    }
}
