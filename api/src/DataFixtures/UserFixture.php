<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

class UserFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $pwd = 'esgi';

        $user = new User();
        $user->setEmail('odessa@gmail.com');
        $user->setFirstname('Odessa');
        $user->setLastname('Chesneau');
        $user->setRole('Admin');
        $user->setPassword($pwd);

        $manager->persist($user);
        $manager->flush();


        $user = new User();
        $user->setEmail('dan@gmail.com');
        $user->setFirstname('Dan');
        $user->setLastname('Levy');
        $user->setRole('Admin');
        $user->setPassword($pwd);

        $manager->persist($user);
        $manager->flush();
        

        $user = new User();
        $user->setEmail('lea@gmail.com');
        $user->setFirstname('Lea');
        $user->setLastname('Ifergan');
        $user->setRole('Admin');
        $user->setPassword($pwd);

        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setEmail('Rina@gmail.com');
        $user->setFirstname('Rina');
        $user->setLastname('Harroch');
        $user->setRole('Admin');
        $user->setPassword($pwd);

        $manager->persist($user);
        $manager->flush();
    }

   
}