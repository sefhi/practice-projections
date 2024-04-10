<?php

declare(strict_types=1);

namespace App\RRSS\Posts\Application\Command;

use App\RRSS\Posts\Domain\Post;
use App\RRSS\Posts\Domain\PostRepository;
use App\Shared\Domain\Bus\Command\CommandHandler;
use App\Shared\Domain\Bus\Event\EventBus;
use App\Shared\Domain\ValueObject\Timestamps;

final class PublishPostCommandHandler implements CommandHandler
{
    public function __construct(
        private readonly PostRepository $postRepository,
        private readonly EventBus $eventBus,
        private readonly Timestamps $dates,
    ) {
    }

    public function __invoke(PublishPostCommand $command): void
    {
        $post = Post::publish(
            $command->id(),
            $command->userId(),
            $command->content(),
            $this->dates->now()
        );

        $this->postRepository->save($post);
        $this->eventBus->publish(...$post->pullDomainEvents());
    }
}
