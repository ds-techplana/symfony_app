<?php

namespace App\DataFixtures;

use App\Domain\Role;
use App\Domain\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $roleUser = Role::create(1, 'user');
        $roleAdmin = Role::create(2, 'admin');
        $roleSuperAdmin = Role::create(3, 'superadmin');
        $manager->persist($roleUser);
        $manager->persist($roleAdmin);
        $manager->persist($roleSuperAdmin);

        $user1 = User::create('User1', 'user1@email.com', $roleUser);
        $user2 = User::create('User2', 'user2@email.com', $roleAdmin);
        $user3 = User::create('User3', 'user3@email.com', $roleSuperAdmin);
        $manager->persist($user1);
        $manager->persist($user2);
        $manager->persist($user3);
        $manager->flush();
    }
}
