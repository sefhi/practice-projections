<?php

declare(strict_types=1);

namespace App\RRSS\Domain\ValueObject;

enum UserStatus: string
{
    case ACTIVE   = 'active';
    case ARCHIVED = 'archived';
    case DELETED  = 'deleted';
}
