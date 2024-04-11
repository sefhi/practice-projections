<?php

namespace App\Tests\Unit\RRSS\Posts\Application\Command;

use App\RRSS\Posts\Application\Command\PostLikesIncrementerCommand;
use App\RRSS\Posts\Application\Command\PostLikesIncrementerCommandHandler;
use App\RRSS\Posts\Domain\Post;
use App\RRSS\Posts\Domain\PostRepository;
use App\Tests\Unit\RRSS\Posts\Domain\PostMother;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class PostLikesIncrementerCommandHandlerTest extends TestCase
{
    private PostRepository|MockObject $postRepository;

    public function setUp(): void
    {
        $this->postRepository = $this->createMock(PostRepository::class);
    }

    /** @test */
    public function itShouldIncrementPostLikes(): void
    {
        $command      = new PostLikesIncrementerCommand(Uuid::uuid7()->toString());
        $postExpected = PostMother::fromId($command->postId());

        $this->postRepository
            ->method('findById')
            ->willReturn($postExpected);

        $this->postRepository
            ->expects(self::once())
            ->method('save')
            ->with(
                self::callback(
                    function (Post $post) use ($postExpected): true {
                        $likesExpected = 1;
                        self::assertEquals($postExpected->id(), $post->id());
                        self::assertEquals($likesExpected, $postExpected->likes());

                        return true;
                    }
                )
            );

        $handler = new PostLikesIncrementerCommandHandler($this->postRepository);

        $handler($command);
    }
}
