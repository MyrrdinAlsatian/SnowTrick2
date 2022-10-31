<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements FixtureGroupInterface
{
    public function __construct(
        private UserPasswordHasherInterface $hasher
    ){}
    public function load(ObjectManager $manager): void
    {
        $now = new \DateTimeImmutable();

        $admin1 = new User();

        $admin1
            ->setUsername('SuperAdmin')
            ->setEmail('stephan.jeanba@gmail.com')
            ->setPassword($this->hasher->hashPassword($admin1, 'Superadmin'))
            ->setRoles(['ROLE_ADMIN'])
            ->setIsVerified(true)
            ->setCreatedAt($now);
            
        $manager->persist($admin1);

        $user1 = new User();
        $user1
            ->setUsername('John Doe')
            ->setEmail('john.doe@unchained.com')
            ->setPassword($this->hasher->hashPassword($user1, '123456'))
            ->setIsVerified(true)
            ->setCreatedAt($now);
        $manager->persist($user1);

        $manager->flush();
    }

    public static function getGroups():array
    {
        return ['user'];
    }
}
