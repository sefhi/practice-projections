<?php

declare(strict_types=1);

namespace App\RRSS\Users\Infrastructure\Api;

use App\RRSS\Users\Infrastructure\Api\Dto\CreateUserDto;
use App\Shared\Api\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

final class CreateUserController extends BaseController
{
    public function __invoke(
        #[MapRequestPayload] CreateUserDto $data
    ): JsonResponse {
        $this->command($data->mapToCreateUserCommand());

        return new JsonResponse('', Response::HTTP_CREATED);
    }

    protected function exceptions(): array
    {
        return [];
    }
}
