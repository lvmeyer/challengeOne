<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Subscription;

class SubscriptionFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $subscription = new Subscription();
        $subscription->setType('Offre Découverte');
        $subscription->setFormality('Mensuel');
        $subscription->setPrice(7);
        $manager->persist($subscription);
        $manager->flush();

        $subscription = new Subscription();
        $subscription->setType('Offre Découverte');
        $subscription->setFormality('Annuel');
        $subscription->setPrice(70);
        $manager->persist($subscription);
        $manager->flush();


        $subscription = new Subscription();
        $subscription->setType('Offre Drol');
        $subscription->setFormality('Mensuel');
        $subscription->setPrice(20);
        $manager->persist($subscription);
        $manager->flush();

        $subscription = new Subscription();
        $subscription->setType('Offre Drol');
        $subscription->setFormality('Annuel');
        $subscription->setPrice(225);
        $manager->persist($subscription);
        $manager->flush();
    }
}
