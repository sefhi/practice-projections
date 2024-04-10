<?php

declare(strict_types=1);

namespace App\RRSS\Posts\Infrastructure\Persistence\Repository;

use App\RRSS\Posts\Domain\Post;
use App\RRSS\Posts\Domain\PostRepository;
use App\Shared\Infrastructure\Persistence\Repository\DoctrineRepository;

final class DoctrinePostRepository extends DoctrineRepository implements PostRepository
{
    public function save(Post $post): void
    {
        $this->persist($post);
    }
}
