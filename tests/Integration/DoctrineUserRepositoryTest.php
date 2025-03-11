<?php
namespace App\Tests\Integration;

use App\Domain\User\Entity\User;
use App\Domain\User\ValueObject\UserId;
use App\Domain\User\ValueObject\Name;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Password;
use App\Domain\User\Repository\DoctrineUserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use PHPUnit\Framework\TestCase;

class DoctrineUserRepositoryTest extends TestCase
{
    private EntityManager $entityManager;
    private DoctrineUserRepository $userRepository;

    protected function setUp(): void
    {
        $config = Setup::createAnnotationMetadataConfiguration([__DIR__ . '/../../src'], true);
        $conn = [
            'driver' => 'pdo_mysql',
            'dbname' => 'prueba_tecnica',
            'user' => 'user',
            'password' => 'password',
            'host' => 'mysql_db',
        ];
        $this->entityManager = EntityManager::create($conn, $config);
        $this->userRepository = new DoctrineUserRepository($this->entityManager);
    }

    public function testSaveAndFindUser(): void
    {
        $userId = new UserId('123');
        $name = new Name('John Doe');
        $email = new Email('john.doe@example.com');
        $password = new Password('Password123!');

        $user = new User($userId, $name, $email, $password);
        $this->userRepository->save($user);

        $foundUser = $this->userRepository->findById($userId);
        $this->assertEquals($user, $foundUser);
    }
}
?>