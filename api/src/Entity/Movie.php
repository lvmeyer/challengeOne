<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @Vich\Uploadable
 */
#[ORM\Entity(repositoryClass: MovieRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['movie:read']], 
    denormalizationContext: ['groups' => ['movie:write']], 
    types: ['https://schema.org/Movie'],
    operations: [
        new GetCollection(),
        new Post(inputFormats: ['multipart' => ['multipart/form-data']])
    ]
)]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $director = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $release_date = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $Duration = null;

    #[ORM\OneToMany(mappedBy: 'movie_id', targetEntity: Comment::class)]
    private Collection $comments;

    #[ORM\OneToMany(mappedBy: 'movie_id', targetEntity: Seance::class)]
    private Collection $seances;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Review $review_id = null;

    #[ApiProperty(types: ['https://schema.org/contentUrl'])]
    #[Groups(['movie:read'])]
    public ?string $contentUrl = null;

     /**
     * @Vich\UploadableField(mapping="media_object", fileNameProperty="filePath")
     */
    #[Groups(['movie:write'])]
    public ?File $file = null;

    #[ORM\Column(nullable: true)] 
    public ?string $filePath = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->seances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDirector(): ?string
    {
        return $this->director;
    }

    public function setDirector(string $director): self
    {
        $this->director = $director;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->release_date;
    }

    public function setReleaseDate(\DateTimeInterface $release_date): self
    {
        $this->release_date = $release_date;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->Duration;
    }

    public function setDuration(int $Duration): self
    {
        $this->Duration = $Duration;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setMovieId($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getMovieId() === $this) {
                $comment->setMovieId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Seance>
     */
    public function getSeances(): Collection
    {
        return $this->seances;
    }

    public function addSeance(Seance $seance): self
    {
        if (!$this->seances->contains($seance)) {
            $this->seances->add($seance);
            $seance->setMovieId($this);
        }

        return $this;
    }

    public function removeSeance(Seance $seance): self
    {
        if ($this->seances->removeElement($seance)) {
            // set the owning side to null (unless already changed)
            if ($seance->getMovieId() === $this) {
                $seance->setMovieId(null);
            }
        }

        return $this;
    }

    public function getReviewId(): ?Review
    {
        return $this->review_id;
    }

    public function setReviewId(?Review $review_id): self
    {
        $this->review_id = $review_id;

        return $this;
    }

    public function updateFile(File $file): void
    {
       $this->file  = $file;
       $this->updatedAt = new DateTime();
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
