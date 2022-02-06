<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use app\Entity\Author;

class AuthorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create("fr_FR");
        for($i=5;$i<=10;$i++){
            $author = new Author();
            $author->setLastname($faker->lastName)
                ->setFirstname($faker->firstName);
            $manager->persist($author);
        }
        $manager->flush();
    }
}
