<?php

namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['article.read']],
    denormalizationContext: ['groups' => ['article.write']]
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'helpBox' => 'exact',
        'slug' => 'exact'
    ]
)]

class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    #[Assert\NotNull, Groups(['article.read', 'article.write'])]

    private ?string $title = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull, Groups(['article.read', 'article.write'])]

    private ?string $description = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull, Groups(['help_box.read', 'article.read', 'article.write'])]

    private ?User $author = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    #[Assert\NotNull, Groups(['article.read', 'article.write'])]

    private ?array $sections = [];

    #[ORM\Column]
    #[Assert\NotNull, Groups(['article.read', 'article.write'])]
    private ?bool $isActive = null;

    #[ORM\Column]
    #[Assert\NotNull, Groups(['article.read', 'article.write'])]
    private ?bool $isPrivate = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['article.read', 'article.write'])]
    private ?string $slug = null;

    #[ORM\ManyToOne(inversedBy: 'article')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull, Groups(['article.read', 'article.write'])]
    private ?HelpBox $helpBox = null;

    public function __construct()
    {
        $this->tag = new ArrayCollection();
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

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getSections(): ?array
    {
        return $this->sections;
    }

    public function setSections(?array $sections): static
    {
        $this->sections = $sections;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function isIsPrivate(): ?bool
    {
        return $this->isPrivate;
    }

    public function setIsPrivate(bool $isPrivate): static
    {
        $this->isPrivate = $isPrivate;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
   

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getHelpBox(): ?HelpBox
    {
        return $this->helpBox;
    }

    public function setHelpBox(?HelpBox $helpBox): static
    {
        $this->helpBox = $helpBox;

        return $this;
    }

    public function setSlugFromTitle(SluggerInterface $slugger): self
    {
        $this->slug = $slugger->slug($this->title)->lower();

        return $this;
    }


}
