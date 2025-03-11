<?php

namespace App\Infrastructure\Controller;

use App\Application\DTO\RegisterUserRequest;
use App\Application\DTO\UserResponseDTO;
use App\Domain\UseCase\RegisterUserUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class RegisterUserController
{
    private RegisterUserUseCase $registerUserUseCase;

    public function __construct(RegisterUserUseCase $registerUserUseCase)
    {
        $this->registerUserUseCase = $registerUserUseCase;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Crear el DTO de solicitud
        $registerUserRequest = new RegisterUserRequest(
            $data['name'],
            $data['email'],
            $data['password']
        );

        // Ejecutar el caso de uso
        $userResponseDTO = $this->registerUserUseCase->execute($registerUserRequest);

        // Devolver la respuesta en formato JSON
        return new JsonResponse($userResponseDTO->toArray(), 201);
    }
}

?>