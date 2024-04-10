<?php

declare(strict_types=1);

namespace App\RRSS\Posts\Domain;

interface PostRepository
{
    public function save(Post $post): void;
}
