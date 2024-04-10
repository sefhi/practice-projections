<?php

declare(strict_types=1);

namespace App\RRSS\Posts\Application\Command;

use App\Shared\Domain\Bus\Command\Command;

final readonly class PublishPostCommand implements Command
{
    public function __construct(
        private string $id,
        private string $userId,
        private string $content,
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function content(): string
    {
        return $this->content;
    }
}
