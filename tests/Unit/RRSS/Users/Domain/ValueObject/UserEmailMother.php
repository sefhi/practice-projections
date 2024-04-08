<?php

declare(strict_types=1);

namespace App\Tests\Unit\RRSS\Users\Domain\ValueObject;

use App\RRSS\Users\Domain\ValueObject\UserEmail;

final class UserEmailMother
{
    public static function create(string $value): UserEmail
    {
        return UserEmail::fromString($value);
    }

    public static function random(): UserEmail
    {
        return self::create('email'.rand(1, 1000).'@mail.com');
    }
}
