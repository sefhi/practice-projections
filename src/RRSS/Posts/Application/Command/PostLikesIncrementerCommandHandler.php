<?php

declare(strict_types=1);

namespace App\RRSS\Posts\Application\Command;

use App\Shared\Domain\Bus\Command\CommandHandler;

class PostLikesIncrementerCommandHandler implements CommandHandler
{
    public function __construct()
    {
    }

    public function __invoke(PostLikesIncrementerCommand $command): void
    {
    }
}
