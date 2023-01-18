<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Ticket;
use App\Entity\Seance;
use App\Entity\User;

class TicketFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $ticket = new Ticket();
        $seance = $manager->getRepository(Seance::class)->findAll()[0];
        $user = $manager->getRepository(User::class)->findAll()[0];

        $ticket->setSeanceId($seance);
        $ticket->setPrice(10);
        $ticket->setUserId($user);

        $manager->persist($ticket);
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            SeanceFixture::class,
            UserFixture::class,
        );
    }
}
