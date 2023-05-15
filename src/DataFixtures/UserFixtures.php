<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    private $userPasswordHasherInterface;

    public function __construct (UserPasswordHasherInterface $userPasswordHasherInterface) 
    {
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername('zahitrios');
        $user->setPassword(
            $this->userPasswordHasherInterface->hashPassword(
                $user, 'tyVe7i%3O791'
            )
        );
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);


        $user = new User();
        $user->setUsername('test');
        $user->setPassword(
            $this->userPasswordHasherInterface->hashPassword(
                $user, 'test'
            )
        );
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);


        $manager->flush();
    }
}
