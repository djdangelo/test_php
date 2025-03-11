<?php

namespace App\Domain\UseCase;

use App\Application\DTO\RegisterUserRequest;
use App\Application\DTO\UserResponseDTO;
use App\Domain\User\Entity\User;
use App\Domain\User\ValueObject\UserId;
use App\Domain\User\ValueObject\Name;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Password;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\Event\UserRegisteredEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class RegisterUserUseCase
{
    private UserRepositoryInterface $userRepository;
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(UserRepositoryInterface $userRepository, EventDispatcherInterface $eventDispatcher)
    {
        $this->userRepository = $userRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function execute(RegisterUserRequest $request): UserResponseDTO
    {
        $userId = new UserId(uniqid());
        $name = new Name($request->getName());
        $email = new Email($request->getEmail());
        $password = new Password($request->getPassword());

        $user = new User($userId, $name, $email, $password);
        $this->userRepository->save($user);

        // Disparar el evento de dominio
        $event = new UserRegisteredEvent($user);
        $this->eventDispatcher->dispatch($event, UserRegisteredEvent::NAME);

        // Crear y devolver el DTO de respuesta
        return new UserResponseDTO(
            $userId->getValue(),
            $name->getValue(),
            $email->getValue(),
            $user->getCreatedAt()->format('Y-m-d H:i:s')
        );
    }
}
?>