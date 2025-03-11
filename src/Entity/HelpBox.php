<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\User;
use App\Repository\HelpBoxRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HelpBoxRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['help_box.read']],
    denormalizationContext: ['groups' => ['help_box.write']]
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'category.name' => 'exact',
        'title' => 'partial',
        'slug' => 'exact',
        'author' => 'exact'
    ]
)]

 #[UniqueEntity(
                             fields: ['title'],
                             errorPath: 'title',
                             message: 'This title is already in use on that host.',
                         )]

class HelpBox
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    #[Assert\NotNull, Groups(['help_box.read', 'help_box.write', 'article.read'])]
    private ?string $title = null;

    #[ORM\Column(length: 200)]
    #[Assert\NotNull, Groups(['help_box.read', 'help_box.write'])]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Groups(['help_box.read', 'help_box.write', 'article.read'])]
    private ?string $slug = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull, Groups(['help_box.read', 'help_box.write', 'article.read'])]
    private ?Category $category = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull, Groups(['help_box.read', 'help_box.write'])]
    private ?User $author = null;

    #[ORM\OneToMany(mappedBy: 'helpBox', targetEntity: Article::class, orphanRemoval: true)]
    #[Groups(['help_box.read', 'help_box.write'])]
    private Collection $article;

    #[ORM\Column(nullable: true)]
    #[Groups(['help_box.read', 'help_box.write'])]
    private ?int $quantityAuthors = null;



    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->article = new ArrayCollection();
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

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


    public function setSlugFromTitle(SluggerInterface $slugger): self
    {
        $this->slug = $slugger->slug($this->title)->lower();

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticle(): Collection
    {
        return $this->article;
    }

    public function addArticle(Article $article): static
    {
        if (!$this->article->contains($article)) {
            $this->article->add($article);
            $article->setHelpBox($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): static
    {
        if ($this->article->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getHelpBox() === $this) {
                $article->setHelpBox(null);
            }
        }

        return $this;
    }

    public function getQuantityAuthors(): ?int
{
    $authors = [];

    foreach ($this->article as $article) {
        $authorId = $article->getAuthor()->getId();
        if (!in_array($authorId, $authors)) {
            $authors[] = $authorId;
        }
    }

    return count($authors);
}


    public function setQuantityAuthors(?int $quantityAuthors): static
    {
        $this->quantityAuthors = $quantityAuthors;

        return $this;
    }

 
}
