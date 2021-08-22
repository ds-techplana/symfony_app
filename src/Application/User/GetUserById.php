<?php

namespace App\Application\User;

use App\Domain\UserRepositoryInterface;
use App\Infrastructure\DTO\UserById;

/**
 * Class GetUserById
 * @package App\Application\User
 */
class GetUserById
{
    /** @var UserRepositoryInterface $userRepository */
    private UserRepositoryInterface $userRepository;

    /**
     * GetUserById constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param UserById $DTO
     * @return mixed
     */
    public function request(UserById $DTO)
    {
        return $this->userRepository->find($DTO->id());
    }
}
