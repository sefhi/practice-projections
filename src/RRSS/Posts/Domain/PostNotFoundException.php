<?php

declare(strict_types=1);

namespace App\RRSS\Posts\Domain;

final class PostNotFoundException extends \DomainException
{
    public function __construct(string $id)
    {
        parent::__construct(sprintf('Post with id <%s> not found', $id));
    }
}
