<?php

declare(strict_types=1);

namespace App\Tests\Unit\RRSS\Users\Domain\ValueObject;

use App\RRSS\Users\Domain\ValueObject\UserName;

final class UserNameMother
{
    public static function create(string $value): UserName
    {
        return UserName::fromString($value);
    }

    public static function random(): UserName
    {
        return self::create('name'.rand(1, 1000));
    }
}
