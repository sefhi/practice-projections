<?php

declare(strict_types=1);

namespace App\RRSS\Users\Domain\ValueObject;

use App\Shared\Domain\ValueObject\Email;

final class UserEmail extends Email
{
    public static function fromString(string $value): self
    {
        return new self($value);
    }
}
