<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\MovieRoom;
use App\Entity\Movie;
use App\Entity\Seance;

class SeanceFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $movie = $manager->getRepository(Movie::class)->findAll()[0];
        $movieRoom = $manager->getRepository(MovieRoom::class)->findAll()[0];

        $seance = new Seance();
        $seance->setStartTime(new \DateTime());
        $seance->setEndTime(new \DateTime());
        $seance->setDate(new \DateTime());
        $seance->setMovieroomId($movieRoom);
        $seance->setPrice(rand (10, 20));
        $seance->setMovieId($movie);
        $manager->persist($seance);
        $manager->flush();

        $movie1 = $manager->getRepository(Movie::class)->findAll()[1];
        $movieRoom1 = $manager->getRepository(MovieRoom::class)->findAll()[1];

        $seance = new Seance();
        $seance->setStartTime(new \DateTime());
        $seance->setEndTime(new \DateTime());
        $seance->setDate(new \DateTime());
        $seance->setMovieroomId($movieRoom1);
        $seance->setPrice(rand (10, 20) / 10);
        $seance->setMovieId($movie1);
        $manager->persist($seance);
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            MovieRoomFixture::class,
            MovieFixture::class,
        );
    }
}
