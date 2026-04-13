<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('it_IT');

        // Creo 3 utenti
        $users = [];
        for ($i = 0; $i < 3; $i++) {
            $user = new User();
            $user->setUsername($faker->userName());
            $user->setEmail($faker->email());
            $manager->persist($user);
            $users[] = $user;
        }

        // Creo 10 post
        for ($i = 0; $i < 10; $i++) {
            $post = new Post();
            $post->setTitle($faker->sentence(4));
            $post->setSlug($faker->slug());
            $post->setContent($faker->paragraphs(3, true));
            $post->setCreatedAt(new \DateTimeImmutable());
            $post->setIsPublished($faker->boolean(80));
            $post->setAuthor($users[array_rand($users)]);
            $manager->persist($post);
        }

        $manager->flush();
    }
}
