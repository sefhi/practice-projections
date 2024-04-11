<?php

declare(strict_types=1);

namespace App\Tests\Unit\Retention\Users\Application\Command;

use App\Retention\Users\Application\Command\IncrementRetentionUserTotalPostsCommandHandler;
use App\Retention\Users\Domain\RetentionUser;
use App\Retention\Users\Domain\RetentionUserNotFoundException;
use App\Retention\Users\Domain\RetentionUserRepository;
use App\Tests\Unit\Retention\Users\Domain\RetentionUserMother;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

final class IncrementRetentionUserTotalPostsCommandHandlerTest extends TestCase
{
    private RetentionUserRepository|MockObject $retentionUserRepository;

    public function setUp(): void
    {
        $this->retentionUserRepository = $this->createMock(RetentionUserRepository::class);
    }

    /** @test */
    public function itShouldIncrementTotalPosts(): void
    {
        $command               = IncrementRetentionUserTotalPostsCommandMother::random();
        $retentionUserExpected = RetentionUserMother::create(
            $command->userId(),
            'name',
            'email@email.es',
        );

        $totalPostExpected = $retentionUserExpected->totalPosts() + 1;

        $this->retentionUserRepository
            ->expects(self::once())
            ->method('findById')
            ->with(Uuid::fromString($command->userId()))
            ->willReturn($retentionUserExpected);

        $this->retentionUserRepository
            ->expects(self::once())
            ->method('save')
            ->with(
                self::callback(
                    function (RetentionUser $retentionUser) use ($totalPostExpected): bool {
                        self::assertEquals($totalPostExpected, $retentionUser->totalPosts());

                        return true;
                    }
                )
            );

        $handler = new IncrementRetentionUserTotalPostsCommandHandler($this->retentionUserRepository);
        $handler($command);
    }

    /** @test */
    public function itShouldIncrementTotalPostsWhenUserDoesNotExist(): void
    {
        $command = IncrementRetentionUserTotalPostsCommandMother::random();

        $this->retentionUserRepository
            ->expects(self::once())
            ->method('findById')
            ->with(Uuid::fromString($command->userId()))
            ->willReturn(null);

        $this->retentionUserRepository
            ->expects(self::never())
            ->method('save');

        $handler = new IncrementRetentionUserTotalPostsCommandHandler($this->retentionUserRepository);

        $this->expectException(RetentionUserNotFoundException::class);

        $handler($command);
    }
}
