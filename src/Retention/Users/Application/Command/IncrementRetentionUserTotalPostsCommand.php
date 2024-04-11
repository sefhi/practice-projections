<?php

declare(strict_types=1);

namespace App\Retention\Users\Application\Command;

use App\Shared\Domain\Bus\Command\Command;

final class IncrementRetentionUserTotalPostsCommand implements Command
{
    public function __construct(private readonly string $userId)
    {
    }

    public function userId(): string
    {
        return $this->userId;
    }
}
