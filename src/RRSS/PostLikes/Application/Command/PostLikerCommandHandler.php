<?php

declare(strict_types=1);

namespace App\RRSS\PostLikes\Application\Command;

use App\RRSS\PostLikes\Domain\PostLike;
use App\RRSS\PostLikes\Domain\PostLikeRepository;
use App\Shared\Domain\Bus\Event\EventBus;
use App\Shared\Domain\ValueObject\Timestamps;

final class PostLikerCommandHandler
{
    public function __construct(
        private readonly PostLikeRepository $postLikeRepository,
        private readonly EventBus $eventBus,
        private readonly Timestamps $timestamps,
    ) {
    }

    public function __invoke(PostLikerCommand $command): void
    {
        $postLike = PostLike::like(
            $command->id(),
            $command->postId(),
            $command->userId(),
            $this->timestamps
        );
        $this->postLikeRepository->save($postLike);
        $this->eventBus->publish(...$postLike->pullDomainEvents());
    }
}
