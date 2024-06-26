<?php

declare(strict_types=1);

namespace App\Tests\Unit\Retention\Users\Domain;

use App\Retention\Users\Domain\RetentionUser;
use Ramsey\Uuid\Uuid;

final class RetentionUserMother
{
    public static function create(
        string $id,
        string $name,
        string $email,
    ): RetentionUser {
        return RetentionUser::create(
            $id,
            $name,
            $email,
        );
    }

    public static function random(): RetentionUser
    {
        return self::create(
            Uuid::uuid7()->toString(),
            'name',
            'email@email.com',
            3,
            3.3,
        );
    }

    public static function createWithTotalPostsAndAveragePostLikes(
        string $id,
        string $name,
        string $email,
        int $totalPosts,
        float $averagePostLikes
    ): RetentionUser {
        return RetentionUser::createWithTotalPostsAndAveragePostLikes(
            $id,
            $name,
            $email,
            $totalPosts,
            $averagePostLikes,
        );
    }
}
