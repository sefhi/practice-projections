<?php

declare(strict_types=1);

namespace App\RRSS\Users\Domain\ValueObject;

enum UserStatus: string
{
    case ACTIVE   = 'active';
    case ARCHIVED = 'archived';
    case DELETED  = 'deleted';
}
