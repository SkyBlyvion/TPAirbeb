<?php


namespace App\Entity;


use App\Repository\FavorisRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: FavorisRepository::class)]
class Favoris
{
   #[ORM\Id]
   #[ORM\GeneratedValue]
   #[ORM\Column]
   private ?int $id = null;

<<<<<<< HEAD
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $User = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Annonce $Annonce = null;
=======

   #[ORM\ManyToOne(inversedBy: 'annonce')]
   #[ORM\JoinColumn(nullable: false)]
   private ?User $user = null;
>>>>>>> 527113a (resolved favorisTable bug)


<<<<<<< HEAD
    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): static
    {
        $this->User = $User;
=======
   #[ORM\ManyToOne(inversedBy: 'favoris')]
   #[ORM\JoinColumn(nullable: false)]
   private ?Annonce $annonce = null;

>>>>>>> 527113a (resolved favorisTable bug)

   public function getId(): ?int
   {
       return $this->id;
   }

<<<<<<< HEAD
    public function getAnnonce(): ?Annonce
    {
        return $this->Annonce;
    }

    public function setAnnonce(?Annonce $Annonce): static
    {
        $this->Annonce = $Annonce;
=======

   public function getUser(): ?User
   {
       return $this->user;
   }
>>>>>>> 527113a (resolved favorisTable bug)


   public function setUser(?User $user): static
   {
       $this->user = $user;


       return $this;
   }


   public function getAnnonce(): ?Annonce
   {
       return $this->annonce;
   }


   public function setAnnonce(?Annonce $annonce): static
   {
       $this->annonce = $annonce;


       return $this;
   }
}
