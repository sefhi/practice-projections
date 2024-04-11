<?php

declare(strict_types=1);

namespace App\RRSS\Posts\Application\Command;

use App\RRSS\Posts\Domain\PostRepository;
use App\Shared\Domain\Bus\Command\CommandHandler;
use Ramsey\Uuid\Uuid;

class PostLikesIncrementerCommandHandler implements CommandHandler
{
    public function __construct(
        private readonly PostRepository $postRepository,
    ) {
    }

    public function __invoke(PostLikesIncrementerCommand $command): void
    {
        $post = $this->postRepository->findById(
            Uuid::fromString($command->postId())
        );

        $post->incrementLikes();

        $this->postRepository->save($post);
    }
}
