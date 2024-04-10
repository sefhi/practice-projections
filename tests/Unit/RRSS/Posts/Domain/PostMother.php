<?php

namespace App\Tests\Unit\RRSS\Posts\Domain;

use App\RRSS\Posts\Application\Command\PublishPostCommand;
use App\RRSS\Posts\Domain\Post;
use App\Tests\Unit\Shared\Domain\ValueObject\TimestampsMother;
use Ramsey\Uuid\Uuid;

class PostMother
{
    public static function publish(
        string $id,
        string $userId,
        string $content,
    ): Post {
        return Post::publish(
            $id,
            $userId,
            $content,
            TimestampsMother::defaultNow(),
        );
    }

    public static function random(): Post
    {
        return self::publish(
            Uuid::uuid7(),
            Uuid::uuid7(),
            'content',
        );
    }

    public static function fromCommand(PublishPostCommand $command): Post
    {
        return self::publish(
            $command->id(),
            $command->userId(),
            $command->content(),
        );
    }
}
