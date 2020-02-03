<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        // Create contact
        for ($i = 0; $i < 10; $i++) {
            $c = new Contact();
            $c->setFirstname($faker->firstName);
            $c->setLastname($faker->lastName);
            $c->setPhone($faker->phoneNumber);
            $manager->persist($c);
        }

        for ($i = 0; $i < 5; $i++) {
            $p = new Product();
            $p->setTitle(sprintf('Licence : %s', $faker->sentence(rand(1,3))));
            $p->setPrice($faker->randomNumber(2));
            $manager->persist($p);
        }

        $manager->flush();
    }
}
