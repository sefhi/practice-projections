<?php

declare(strict_types=1);

namespace App\RRSS\Domain\ValueObject;

use App\Shared\Domain\ValueObject\StringValueObject;

final class UserProfilePicture extends StringValueObject
{
    public static function fromString(string $value): self
    {
        return new self($value);
    }
}
