<?php

namespace App\DataFixtures;

use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Book;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class BooksFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher){
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create("fr_FR");
        $user = new UserRepository();
        $utilisateur = $user->find(1);
        for($i=1; $i<=10; $i++ ) {
            $book = new Book();
            $book->setTitle($faker->sentence)
                ->setPublisher($faker->name)
                ->setYear($faker->year)
                ->setIsbn($faker->isbn10())
                ->setBackCover($faker->realText)
                ->setCover($faker->boolean);
            $manager->persist($book);
        }
        $manager->flush();
    }
}
