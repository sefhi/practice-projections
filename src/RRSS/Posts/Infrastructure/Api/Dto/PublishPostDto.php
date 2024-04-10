<?php

declare(strict_types=1);

namespace App\RRSS\Posts\Infrastructure\Api\Dto;

use App\RRSS\Posts\Application\Command\PublishPostCommand;

final class PublishPostDto
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

    public function mapToPublishPostCommand(): PublishPostCommand
    {
        return new PublishPostCommand(
            $this->id,
            $this->userId,
            $this->content,
        );
    }
}
