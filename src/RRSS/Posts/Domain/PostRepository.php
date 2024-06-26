<?php

declare(strict_types=1);

namespace App\RRSS\Posts\Domain;

use Ramsey\Uuid\UuidInterface;

interface PostRepository
{
    public function save(Post $post): void;

    public function findById(UuidInterface $id): ?Post;
}
