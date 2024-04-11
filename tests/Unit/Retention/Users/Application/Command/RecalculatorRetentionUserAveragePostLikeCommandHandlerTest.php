<?php

declare(strict_types=1);

namespace App\Tests\Unit\Retention\Users\Application\Command;

use App\Retention\Users\Application\Command\RecalculatorRetentionUserAveragePostLikeCommandHandler;
use App\Retention\Users\Domain\RetentionUser;
use App\Retention\Users\Domain\RetentionUserNotFoundException;
use App\Retention\Users\Domain\RetentionUserRepository;
use App\Tests\Unit\Retention\Users\Domain\RetentionUserMother;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class RecalculatorRetentionUserAveragePostLikeCommandHandlerTest extends TestCase
{
    private RetentionUserRepository|MockObject $retentionUserRepository;

    public function setUp(): void
    {
        $this->retentionUserRepository = $this->createMock(RetentionUserRepository::class);
    }

    /** @test */
    public function itShouldRecalculateRetentionUserAveragePostLike(): void
    {
        $command               = RecalculatorRetentionUserAveragePostLikeCommandMother::random();
        $retentionUserExpected = RetentionUserMother::createWithTotalPostsAndAveragePostLikes(
            $command->userId(),
            'name',
            'email',
            3,
            3
        );

        $averageExpected = 3;

        $this->retentionUserRepository
            ->expects(self::once())
            ->method('findById')
            ->willReturn($retentionUserExpected);

        $this->retentionUserRepository
            ->expects(self::once())
            ->method('save')
            ->with(
                self::callback(
                    function (RetentionUser $retentionUser) use ($averageExpected): true {
                        self::assertEquals($averageExpected, $retentionUser->averagePostLikes());

                        return true;
                    }
                )
            );

        $handler = new RecalculatorRetentionUserAveragePostLikeCommandHandler($this->retentionUserRepository);
        $handler($command);
    }

    /** @test */
    public function itNotShouldRecalculateRetentionUserAveragePostLikeWhenUserNotFound(): void
    {
        $command = RecalculatorRetentionUserAveragePostLikeCommandMother::random();

        $this->retentionUserRepository
            ->expects(self::once())
            ->method('findById')
            ->willReturn(null);

        $this->expectException(RetentionUserNotFoundException::class);
        $handler = new RecalculatorRetentionUserAveragePostLikeCommandHandler($this->retentionUserRepository);
        $handler($command);
    }
}
