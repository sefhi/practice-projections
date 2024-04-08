<?php

declare(strict_types=1);

namespace App\RRSS\Users\Domain;

use App\Shared\Domain\Bus\Event\DomainEvent;

final class UserRegisteredDomainEvent extends DomainEvent
{
    public function __construct(
        private readonly string $id,
        private readonly string $name,
        private readonly string $email,
        private readonly string $profilePicture,
        private readonly string $status,
        ?string $eventId = null,
        ?string $occurredOn = null
    ) {
        parent::__construct($id, $eventId, $occurredOn);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getProfilePicture(): string
    {
        return $this->profilePicture;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        ?string $eventId = null,
        ?string $occurredOn = null
    ): self {
        return new self(
            $aggregateId,
            $body['name'],
            $body['email'],
            $body['profilePicture'],
            $body['status'],
            $eventId,
            $occurredOn
        );
    }

    public static function eventName(): string
    {
        return 'practice-projections.rrss.user.registered';
    }

    public function toPrimitives(): array
    {
        return [
            'id'             => $this->id,
            'name'           => $this->name,
            'email'          => $this->email,
            'profilePicture' => $this->profilePicture,
            'status'         => $this->status,
        ];
    }
}
