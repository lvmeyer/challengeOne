<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $pwd = 'esgi';

        $user = new User();
        $user->setEmail('odessa@gmail.com');
        $user->setFirstname('Odessa');
        $user->setLastname('Chesneau');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($pwd);

        $manager->persist($user);
        $manager->flush();


        $user = new User();
        $user->setEmail('dan@gmail.com');
        $user->setFirstname('Dan');
        $user->setLastname('Levy');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($pwd);

        $manager->persist($user);
        $manager->flush();
        

        $user = new User();
        $user->setEmail('lea@gmail.com');
        $user->setFirstname('Lea');
        $user->setLastname('Ifergan');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($pwd);

        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setEmail('Rina@gmail.com');
        $user->setFirstname('Rina');
        $user->setLastname('Harroch');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($pwd);

        $manager->persist($user);
        $manager->flush();
    }

   
}