<?php

namespace App\Tests;

use App\Application\User\CreateUserCommand;
use App\Domain\Role;
use App\Domain\RoleRepositoryInterface;
use App\Domain\User;
use App\Infrastructure\DTO\CreateUser;
use App\Infrastructure\Validation\UserValidation;
use Doctrine\ORM\EntityManagerInterface;
use http\Exception\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\Validator\Exception\ValidatorException;

class CreateUserCommandTest extends KernelTestCase
{
    /**
     * @var EntityManagerInterface
     */
    private ?EntityManagerInterface $entityManager;

    /**
     * This method is called before each test.
     */
    protected function setUp(): void
    {
        $kernel = self::bootKernel([
            'environment' => 'dev',
            'debug'       => true,
        ]);

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->entityManager->beginTransaction();
    }

    /**
     * This method is called after each test.
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->rollback();
        $this->entityManager->close();
        $this->entityManager = null;
    }

    public function testCreateUserWillFailValidation()
    {
        $this->expectException(ValidatorException::class);

        UserValidation::createUser(
            new Request([], [
                'name' => 'testNameWIllFailTooLong',
                'email' => 'test@test.com',
                'role' => 1
            ])
        );
    }

    public function createUser()
    {
        $roleRepo = $this->entityManager->getRepository(Role::class);
        $role = $roleRepo->findByName('admin');
        $roleRepositoryMock = $this->createMock(RoleRepositoryInterface::class);
        $roleRepositoryMock->method('find')->willReturn($role[0]);
        $createUserDTOMock = $this->createMock(CreateUser::class);
        $createUserDTOMock->method('role')->willReturn($role);
        $createUserDTOMock->method('name')->willReturn('name1');
        $createUserDTOMock->method('email')->willReturn('email1');
        $createCommand = new CreateUserCommand($roleRepositoryMock, $this->entityManager);
        $createCommand->handle($createUserDTOMock);
        $userRepo = $this->entityManager->getRepository(User::class);
        return $userRepo->findOneBy(['name' => 'name1']);
    }

    public function testCreateUserCommandConflictHttpExceptionOnDuplicateName()
    {
        $user = $this->createUser();
        self::assertEquals('admin', $user->getRole()->getName());

        $this->expectException(ConflictHttpException::class);
        $this->createUser();
    }

    public function testCreateUserCommandSuccessful()
    {
        $user = $this->createUser();

        self::assertEquals('admin', $user->getRole()->getName());
    }
}
