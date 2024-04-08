<?php

declare(strict_types=1);

namespace App\RRSS\Users\Domain\ValueObject;

use App\Shared\Domain\ValueObject\StringValueObject;

final class UserName extends StringValueObject
{
    public static function fromString(string $value): self
    {
        return new self($value);
    }
}
