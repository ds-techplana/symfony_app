<?php

namespace App\Application\User;

use App\Domain\UserRepositoryInterface;

/**
 * Class GetAllUsers
 * @package App\Application\User
 */
class GetAllUsers
{
    /** @var UserRepositoryInterface $userRepository */
    private UserRepositoryInterface $userRepository;

    /**
     * GetAllUsers constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return mixed
     */
    public function request()
    {
        return $this->userRepository->findAll();
    }
}
