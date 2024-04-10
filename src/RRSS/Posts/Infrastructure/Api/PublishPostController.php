<?php

declare(strict_types=1);

namespace App\RRSS\Posts\Infrastructure\Api;

use App\RRSS\Posts\Infrastructure\Api\Dto\PublishPostDto;
use App\Shared\Api\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

final class PublishPostController extends BaseController
{
    public function __invoke(
        #[MapRequestPayload] PublishPostDto $dto
    ): JsonResponse {
        $this->command($dto->mapToPublishPostCommand());

        return new JsonResponse([], JsonResponse::HTTP_OK);
    }

    protected function exceptions(): array
    {
        return [];
    }
}
