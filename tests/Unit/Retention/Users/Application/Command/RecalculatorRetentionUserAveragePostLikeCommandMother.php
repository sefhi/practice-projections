<?php

declare(strict_types=1);

namespace App\Tests\Unit\Retention\Users\Application\Command;

use App\Retention\Users\Application\Command\RecalculatorRetentionUserAveragePostLikeCommand;
use Ramsey\Uuid\Uuid;

final class RecalculatorRetentionUserAveragePostLikeCommandMother
{
    public static function create(string $userId): RecalculatorRetentionUserAveragePostLikeCommand
    {
        return new RecalculatorRetentionUserAveragePostLikeCommand($userId);
    }

    public static function random(): RecalculatorRetentionUserAveragePostLikeCommand
    {
        return self::create(Uuid::uuid7()->toString());
    }
}
