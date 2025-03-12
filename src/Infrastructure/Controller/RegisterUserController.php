<?php

namespace App\Infrastructure\Controller;

use App\Application\DTO\RegisterUserRequest;
use App\Application\DTO\UserResponseDTO;
use App\Domain\UseCase\RegisterUserUseCase;
use Symfony\Component\HttpFoundation\Request;

class RegisterUserController
{
    private RegisterUserUseCase $registerUserUseCase;

    public function __construct(RegisterUserUseCase $registerUserUseCase)
    {
        $this->registerUserUseCase = $registerUserUseCase;
    }

    public function __invoke(Request $request) 
    {
        $data = json_decode($request->getContent(), true);

       
        $registerUserRequest = new RegisterUserRequest(
            $data['name'],
            $data['email'],
            $data['password']
        );

        
        $userResponseDTO = $this->registerUserUseCase->execute($registerUserRequest);

        
        return json_encode($userResponseDTO->toArray(), 201);
    }
}

?>