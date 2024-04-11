<?php

declare(strict_types=1);

namespace App\RRSS\PostLikes\Domain;

interface PostLikeRepository
{
    public function save(PostLike $postLike): void;
}
