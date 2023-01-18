<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Movie;

class MovieFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $movie = new Movie();
        $movie->setTitle('Le Roi Lion');
        $movie->setDuration(120);
        $movie->setDirector('Jon Favreau');
        $movie->setDescription('Le Roi Lion est un film américain réalisé par Jon Favreau, sorti en 2019. Il s’agit d’une adaptation en images de synthèse du film d’animation Le Roi Lion de 1994, réalisé par Roger Allers et Rob Minkoff. Le film est produit par Walt Disney Pictures et distribué par The Walt Disney Company France. Il est sorti en France le 17 juillet 2019.');
        $movie->setReleaseDate(new \DateTime('2019-07-17'));
        $manager->persist($movie);
        $manager->flush();

        $movie = new Movie();
        $movie->setTitle('Avatar');
        $movie->setDuration(120);
        $movie->setDirector('James Cameron');
        $movie->setDescription('Avatar est un film américain de science-fiction réalisé par James Cameron, sorti en 2009. Il s’agit du premier film de la trilogie Avatar, suivie par Avatar 2 et Avatar 3. Le film est produit par 20th Century Fox et distribué par The Walt Disney Company France. Il est sorti en France le 17 juillet 2019.');
        $movie->setReleaseDate(new \DateTime('2019-07-17'));
        $manager->persist($movie);
        $manager->flush();
    }
}
