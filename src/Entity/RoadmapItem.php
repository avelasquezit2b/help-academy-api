<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\RoadmapItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoadmapItemRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['RoadmapItem.read']],
    denormalizationContext: ['groups' => ['RoadmapItem.write']]
)]

#[ApiFilter(
    SearchFilter::class,
    properties: [
        'year' => 'exact'
    ]
)]
class RoadmapItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups(['RoadmapItem.read', 'RoadmapItem.write'])]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    #[Groups(['RoadmapItem.read', 'RoadmapItem.write'])]
    private ?string $description = null;

    #[ORM\Column(length: 25)]
    #[Groups(['RoadmapItem.read', 'RoadmapItem.write'])]
    private ?string $quarter = null;

    #[ORM\Column]
    #[Groups(['RoadmapItem.read', 'RoadmapItem.write'])]
    private ?int $year = null;

    #[ORM\Column(type: "datetime", nullable: true)]
    #[Groups(['RoadmapItem.read', 'RoadmapItem.write'])]
    private ?\DateTimeInterface $date = null;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getQuarter(): ?string
    {
        return $this->quarter;
    }

    public function setQuarter(string $quarter): static
    {
        $this->quarter = $quarter;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }
}
