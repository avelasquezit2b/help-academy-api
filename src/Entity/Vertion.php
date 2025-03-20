<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\VertionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VertionRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['vertion.read']],
    denormalizationContext: ['groups' => ['vertion.write']]
)]
class Vertion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['vertion.read', 'vertion.write'])]
    private ?string $title = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['vertion.read', 'vertion.write'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    #[Groups(['vertion.read', 'vertion.write'])]
    private ?array $bugs = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    #[Groups(['vertion.read', 'vertion.write'])]
    private ?array $features = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    #[Groups(['vertion.read', 'vertion.write'])]
    private ?array $notes = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['vertion.read', 'vertion.write'])]
    private ?\DateTimeInterface $date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getBugs(): ?array
    {
        return $this->bugs;
    }

    public function setBugs(?array $bugs): static
    {
        $this->bugs = $bugs;

        return $this;
    }

    public function getFeatures(): ?array
    {
        return $this->features;
    }

    public function setFeatures(?array $features): static
    {
        $this->features = $features;

        return $this;
    }

    public function getNotes(): ?array
    {
        return $this->notes;
    }

    public function setNotes(?array $notes): static
    {
        $this->notes = $notes;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }
    
}
