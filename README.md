# Launch Project

- docker-compose up —build
- docker exec -it phpairbeb composer install
- docker exec -it phpairbeb php bin/console d:d:c -- Créer base de données
- populer avec exportbdd

# Libs

- Symfony\Bundle\FrameworkBundle\FrameworkBundle
- Symfony\Bundle\TwigBundle\TwigBundle
- Twig\Extra\TwigExtraBundle\TwigExtraBundle
- Doctrine\Bundle\DoctrineBundle\DoctrineBundle
- Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundl
- Symfony\Bundle\MakerBundle\MakerBundle
- Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle
- Symfony\Bundle\WebProfilerBundle\WebProfilerBundle
- Vich\UploaderBundle\VichUploaderBundle
- Symfony\Bundle\SecurityBundle\SecurityBundle