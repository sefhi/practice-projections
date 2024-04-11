<?php

declare(strict_types=1);

namespace App\Retention\Users\Domain;

final class RetentionUserNotFoundException extends \DomainException
{
    public function __construct(string $id)
    {
        parent::__construct(sprintf('Retention user with id <%s> not found', $id));
    }
}
