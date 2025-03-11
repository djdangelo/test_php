<?php
namespace App\Tests\Unit;

use App\Application\DTO\UserResponseDTO;
use App\Domain\UseCase\RegisterUserUseCase;
use App\Infrastructure\Controller\RegisterUserController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class RegisterUserControllerTest extends TestCase
{
    public function testRegisterUser(): void
    {
        // Mock del caso de uso
        $registerUserUseCase = $this->createMock(RegisterUserUseCase::class);
        $registerUserUseCase->method('execute')
            ->willReturn(new UserResponseDTO('123', 'John Doe', 'john.doe@example.com', '2023-10-01 12:00:00'));

        // Crear el controlador
        $controller = new RegisterUserController($registerUserUseCase);

        // Crear una solicitud HTTP simulada
        $request = new Request([], [], [], [], [], [], json_encode([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => 'Password123!',
        ]));

        // Ejecutar el controlador
        $response = $controller->__invoke($request);

        // Verificar la respuesta
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals([
            'id' => '123',
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'createdAt' => '2023-10-01 12:00:00',
        ], json_decode($response->getContent(), true));
    }
}
?>