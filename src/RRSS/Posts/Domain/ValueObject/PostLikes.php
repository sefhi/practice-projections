<?php

declare(strict_types=1);

namespace App\RRSS\Posts\Domain\ValueObject;

use App\Shared\Domain\ValueObject\IntValueObject;

final class PostLikes extends IntValueObject
{
    public static function fromInteger(int $value): self
    {
        return new self($value);
    }

    public function increment(): self
    {
        return new self($this->value() + 1);
    }

    public function decrement(): self
    {
        return new self($this->value() - 1);
    }

    public static function init(): self
    {
        return new self(0);
    }
}
