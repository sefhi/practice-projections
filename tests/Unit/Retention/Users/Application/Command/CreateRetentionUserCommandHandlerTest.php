<?php

namespace App\Tests\Unit\Retention\Users\Application\Command;

use App\Retention\Users\Application\Command\CreateRetentionUserCommandHandler;
use App\Retention\Users\Domain\RetentionUser;
use App\Retention\Users\Domain\RetentionUserRepository;
use App\Tests\Unit\Retention\Users\Domain\RetentionUserMother;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class CreateRetentionUserCommandHandlerTest extends TestCase
{
    private RetentionUserRepository|MockObject $retentionUserRepository;

    public function setUp(): void
    {
        $this->retentionUserRepository = $this->createMock(RetentionUserRepository::class);
    }

    /** @test */
    public function itShouldCreateUserRetention(): void
    {
        // GIVEN

        $command = CreateRetentionUserCommandMother::random();

        // WHEN

        $this->retentionUserRepository
            ->expects(self::once())
            ->method('findById')
            ->with(Uuid::fromString($command->getId()))
            ->willReturn(null);

        $this->retentionUserRepository
            ->expects(self::once())
            ->method('save')
            ->with(
                RetentionUser::create(
                    $command->getId(),
                    $command->getName(),
                    $command->getEmail(),
                )
            );

        $handler = new CreateRetentionUserCommandHandler($this->retentionUserRepository);
        $handler($command);
    }

    /** @test */
    public function itNotShouldCreateUserRetentionWhenUserExist(): void
    {
        // GIVEN

        $command = CreateRetentionUserCommandMother::random();

        // WHEN

        $this->retentionUserRepository
            ->expects(self::once())
            ->method('findById')
            ->with(Uuid::fromString($command->getId()))
            ->willReturn(RetentionUserMother::random());

        $this->retentionUserRepository
            ->expects(self::never())
            ->method('save');

        $handler = new CreateRetentionUserCommandHandler($this->retentionUserRepository);
        $handler($command);
    }
}
