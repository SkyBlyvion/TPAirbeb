<?php

namespace App\Entity;

use App\Repository\AnnonceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: AnnonceRepository::class)]
#[Vich\Uploadable] 
class Annonce
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $countryname = null;

    #[ORM\Column(length: 255)]
    private ?string $cityname = null;

    #[ORM\Column(length: 255)]
    private ?string $streetname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image_path = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image_slug = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: '0')]
    private ?string $prix = null;

    #[ORM\Column]
    private ?int $nombre_couchage = null;

    #[ORM\Column]
    private ?int $nombre_piece = null;

    #[ORM\Column]
    private ?int $taille = null;

    #[ORM\OneToMany(mappedBy: 'annonce', targetEntity: Reservation::class)]
    private Collection $reservations;

    #[ORM\ManyToOne(targetEntity: Type::class, inversedBy: 'annonces')]
    private ?Type $type = null;

    #[ORM\ManyToMany(targetEntity: Equipement::class, inversedBy: 'annonces')]
    private Collection $equipements;

    #[ORM\ManyToOne(inversedBy: 'annonces')]
    private ?User $user = null;

    #[Vich\UploadableField(mapping: 'house', fileNameProperty: 'image_path')]
    private $imageFile;

    #[ORM\OneToMany(mappedBy: 'annonce', targetEntity: Favoris::class)]
    private Collection $favoris;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->equipements = new ArrayCollection();
        $this->favoris = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCountryname(): ?string
    {
        return $this->countryname;
    }

    public function setCountryname(string $countryname): static
    {
        $this->countryname = $countryname;

        return $this;
    }

    public function getCityname(): ?string
    {
        return $this->cityname;
    }

    public function setCityname(string $cityname): static
    {
        $this->cityname = $cityname;

        return $this;
    }

    public function getStreetname(): ?string
    {
        return $this->streetname;
    }

    public function setStreetname(string $streetname): static
    {
        $this->streetname = $streetname;

        return $this;
    }

    public function getImagePath(): ?string
    {
        return $this->image_path;
    }

    public function setImagePath(?string $image_path): static
    {
        $this->image_path = $image_path;

        return $this;
    }

    public function getImageFile(): ?\Stringable
    {
        return $this->imageFile;
    }

    public function setImageFile(?\Stringable $imageFile): void
    {
        $this->imageFile = $imageFile;
    }

    public function getImageSlug(): ?string
    {
        return $this->image_slug;
    }

    public function setImageSlug(?string $image_slug): static
    {
        $this->image_slug = $image_slug;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getNombreCouchage(): ?int
    {
        return $this->nombre_couchage;
    }

    public function setNombreCouchage(int $nombre_couchage): static
    {
        $this->nombre_couchage = $nombre_couchage;

        return $this;
    }

    public function getNombrePiece(): ?int
    {
        return $this->nombre_piece;
    }

    public function setNombrePiece(int $nombre_piece): static
    {
        $this->nombre_piece = $nombre_piece;

        return $this;
    }

    public function getTaille(): ?int
    {
        return $this->taille;
    }

    public function setTaille(int $taille): static
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setAnnonce($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getAnnonce() === $this) {
                $reservation->setAnnonce(null);
            }
        }

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }
    
    public function setType(?Type $type): self
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * @return Collection<int, Equipement>
     */
    public function getEquipements(): Collection
    {
        return $this->equipements;
    }

    public function addEquipement(Equipement $equipement): static
    {
        if (!$this->equipements->contains($equipement)) {
            $this->equipements->add($equipement);
        }

        return $this;
    }

    public function removeEquipement(Equipement $equipement): static
    {
        $this->equipements->removeElement($equipement);

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Favoris>
     */
    public function getFavoris(): Collection
    {
        return $this->favoris;
    }

    public function addFavori(Favoris $favori): static
    {
        if (!$this->favoris->contains($favori)) {
            $this->favoris->add($favori);
            $favori->setAnnonce($this);
        }

        return $this;
    }

    public function removeFavori(Favoris $favori): static
    {
        if ($this->favoris->removeElement($favori)) {
            // set the owning side to null (unless already changed)
            if ($favori->getAnnonce() === $this) {
                $favori->setAnnonce(null);
            }
        }

        return $this;
    }
}
