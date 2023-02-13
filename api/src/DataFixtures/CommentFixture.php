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

        $user1 = $manager->getRepository(User::class)->findAll()[0];
        $movie1 = $manager->getRepository(Movie::class)->findAll()[0];

        $comment1 = new Comment();
        $comment1->setTitle('Bon film');
        $comment1->setDescription('J\'ai bien aimé... Vraiment bienzjkghzohezfze rtfyghujiktrdfyguhijouhgtyfrgyhuigytfrdyguhijyftrdgyuhij');
        $comment1->setDate(new \DateTime('2020-07-17'));
        $comment1->setUserId($user1);
        $comment1->setMovieId($movie1);
        $manager->persist($comment1);

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
