<?php

declare(strict_types=1);

namespace App\Tests\Unit\RRSS\Users\Domain\ValueObject;

use App\RRSS\Users\Domain\ValueObject\UserProfilePicture;

final class UserProfilePictureMother
{
    public static function create(string $value): UserProfilePicture
    {
        return UserProfilePicture::fromString($value);
    }

    public static function random(): UserProfilePicture
    {
        return self::create('profile_picture'.rand(1, 1000).'.png');
    }
}
