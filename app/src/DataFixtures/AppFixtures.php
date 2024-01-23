<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Type;
use App\Entity\User;
use App\Entity\Annonce;
use App\Entity\Equipement;
use App\Entity\Reservation;
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

        $faker = Factory::create('fr-FR');

        // création des users
        $user = new User();
        $user->setName('toto');
        $user->setFirstname('oot');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->encoder->hashPassword($user, 'admin2024'));
        $user->setEmail('toto@toto.com');
        $manager->persist($user);
     
      

        // création des administrateurs
        $user = new User();
        $user->setName('tata');
        $user->setFirstname('aat');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->encoder->hashPassword($user, 'admin2024'));
        $user->setEmail('tata@tata.com');
        $manager->persist($user);
  

        //boucle de création des annonces
         for ($i = 0; $i < 10; $i++) {
            $annonce = new Annonce();
            $annonce->setTitle($faker->word(3));
            $annonce->setDescription($faker->word(10));
            $annonce->setCountryname($faker->country);
            $annonce->setCityname($faker->city);
            $annonce->setStreetname($faker->streetName);
            $annonce->setImagePath($faker->imageUrl());
            $annonce->setImageSlug($faker->word(5));
            $annonce->setPrix($faker->randomFloat(2, 10, 1000));
            $annonce->setNombreCouchage($faker->numberBetween(1, 10));
            $annonce->setNombrePiece($faker->numberBetween(1, 10));
            $annonce->setTaille($faker->numberBetween(1, 100));
            $manager->persist($annonce);
            $annonces[] = $annonce;
        }

        // boucle de création des equipements
        for ($i = 0; $i < 20; $i++) {
            $equipement = new Equipement();
            $equipement->setLabel($faker->word(1));
            $manager->persist($equipement);
        }
      
        // boucle de création des types
        for ($i = 0; $i < 20; $i++) {
           $type = new Type();
           $type->setLabel($faker->word(3));
           $manager->persist($type);

        }



        // // Reservation Creation: When creating reservations,
        // // you're using $annonce and $user which are set in the last iteration of their respective loops. 
        // // This means all reservations will be linked to the last Annonce and User created in the loop. 
        // // If this isn't intentional, you may want to revise this logic.
        // // Missing Randomization in Reservation Creation: In the reservations loop, you should randomize the selection of Annonce and User for each Reservation. Currently, it uses the last created Annonce and User for all reservations.
        
        $anonces = [];
        // boucle de création des reservations
        for ($i = 0; $i < 20; $i++) {
            $reservation = new Reservation();

            // randomly select an Annonce and user from the arrays
            $annonce = $annonces[array_rand($annonces)];
            

            $reservation->setAnnonce($annonce);
            $reservation->setUserId($user);
            $reservation->setHasAnimal($faker->boolean);
            $reservation->setStatus($faker->word(3));
            $reservation->setDateFin($faker->dateTimeBetween('now', '+1 month'));
            $reservation->setDateDebut($faker->dateTimeBetween('now', '+1 month'));

            $manager->persist($reservation);
          
        }

        $manager->flush();
    }

}
