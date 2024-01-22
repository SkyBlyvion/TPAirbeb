<?php

namespace App\Entity;

use App\Repository\AnnonceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnnonceRepository::class)]
class Annonce
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $uniqueId = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUniqueId(): ?int
    {
        return $this->uniqueId;
    }

    public function setUniqueId(int $uniqueId): static
    {
        $this->uniqueId = $uniqueId;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

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
}
