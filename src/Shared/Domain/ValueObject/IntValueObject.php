<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

abstract class IntValueObject
{
    protected function __construct(
        protected int $value
    ) {
    }

    public function value(): int
    {
        return $this->value;
    }

    public function isEqualTo(self $other): bool
    {
        return $this->value() === $other->value();
    }

    abstract public static function fromInteger(int $value): self;
}
