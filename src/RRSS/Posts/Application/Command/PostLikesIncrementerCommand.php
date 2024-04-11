<?php

declare(strict_types=1);

namespace App\RRSS\Posts\Application\Command;

use App\Shared\Domain\Bus\Command\Command;

final class PostLikesIncrementerCommand implements Command
{
    public function __construct(
        private string $postId
    ) {
    }

    public function postId(): string
    {
        return $this->postId;
    }
}
