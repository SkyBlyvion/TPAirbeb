<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $encoder; // définition d'une popriete privé ou l'on instenciera
    // l'interface d'encodage du mot pass

    public function __construct(UserPasswordHasherInterface $hasher)
    {
    $this->encoder = $hasher; // injection de l'interface dans la propriete
    }

    /**
    * @inheritDoc
    */
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setNom('toto');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->encoder->hashPassword($user, 'admin2024'));
        $user->setEmail('toto@toto.com');
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setNom('tata');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->encoder->hashPassword($user, 'admin2024'));
        $user->setEmail('tata@tata.com');
        $manager->persist($user);
        $manager->flush();

    }


}
