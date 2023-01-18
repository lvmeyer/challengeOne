<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Comment;
use App\Entity\Movie;
use App\Entity\User;

class CommentFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $user = $manager->getRepository(User::class)->findAll()[0];
        $movie = $manager->getRepository(Movie::class)->findAll()[0];

        $comment = new Comment();
        $comment->setTitle('Pas mal');
        $comment->setDescription('C\'est un bon film .. rtfyghujiktrdfyguhijouhgtyfrgyhuigytfrdyguhijyftrdgyuhij');
        $comment->setDate(new \DateTime('2020-07-17'));
        $comment->setUserId($user);
        $comment->setMovieId($movie);
        $manager->persist($comment);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixture::class,
            MovieFixture::class,
        );
    }
}
