<?php

declare(strict_types=1);

namespace App\RRSS\PostLikes\Application\Command;

use App\Shared\Domain\Bus\Command\Command;

final readonly class PostLikerCommand implements Command
{
    public function __construct(
        private string $id,
        private string $postId,
        private string $userId
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function postId(): string
    {
        return $this->postId;
    }

    public function userId(): string
    {
        return $this->userId;
    }
}
