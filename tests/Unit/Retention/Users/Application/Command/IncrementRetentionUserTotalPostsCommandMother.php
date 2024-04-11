<?php

declare(strict_types=1);

namespace App\Tests\Unit\Retention\Users\Application\Command;

use App\Retention\Users\Application\Command\IncrementRetentionUserTotalPostsCommand;
use Ramsey\Uuid\Uuid;

final class IncrementRetentionUserTotalPostsCommandMother
{
    public static function random(): IncrementRetentionUserTotalPostsCommand
    {
        return new IncrementRetentionUserTotalPostsCommand(Uuid::uuid7()->toString());
    }
}
