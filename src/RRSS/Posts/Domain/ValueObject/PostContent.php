<?php

declare(strict_types=1);

namespace App\RRSS\Posts\Domain\ValueObject;

use App\Shared\Domain\ValueObject\StringValueObject;

final class PostContent extends StringValueObject
{
    public static function fromString(string $value): self
    {
        return new self($value);
    }
}
