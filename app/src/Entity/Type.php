<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $uniqueId = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

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

    public function getLabelType(): ?string
    {
        return $this->label;
    }

    public function setLabelType(string $label): static
    {
        $this->label = $label;

        return $this;
    }
}
