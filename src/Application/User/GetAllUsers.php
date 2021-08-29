<?php

namespace App\Application\User;

use App\Domain\UserRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;

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
     * @param Request $request
     * @return array
     */
    public function request(Request $request)
    {
        $order = $request->get('order');
        $orderBy = $request->get('orderBy');
        if($order && $orderBy) {
            return $this->userRepository->findAll($order, $orderBy);
        }

        return $this->userRepository->findAll();
    }
}
