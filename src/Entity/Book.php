<?php

namespace App\Entity;

use App\Repository\BookRepository;
use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 * @Vich\Uploadable
 */
class Book
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @Vich\UploadableField(mapping="coverFile", fileNameProperty="coverName")
     *
     * @var File|null
     */
    private $coverFile;

    /**
     * @ORM\Column(type="string")
     *
     * @var string|null
     */
    private $coverName;

    /**
     * @ORM\ManyToOne(targetEntity=BookCollection::class, inversedBy="books")
     * @ORM\JoinColumn(nullable=false)
     */
    private $collection;

    /**
     * @ORM\OneToMany(targetEntity=Chapter::class, mappedBy="book")
     */
    private $chapters;

    /**
     * @ORM\OneToMany(targetEntity=Resource::class, mappedBy="book")
     */
    private $resources;

    public function __construct()
    {
        $this->chapters = new ArrayCollection();
        $this->resources = new ArrayCollection();
    }

    /**
     * @return DateTimeInterface
     */
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     * @return Book
     */
    public function setCreatedAt(DateTime $createdAt): Book
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getUpdatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     * @return Book
     */
    public function setUpdatedAt(DateTime $updatedAt): Book
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getCollection(): ?BookCollection
    {
        return $this->collection;
    }

    public function setCollection(?BookCollection $collection): self
    {
        $this->collection = $collection;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getChapters(): Collection
    {
        return $this->chapters;
    }

    public function addChapter(Chapter $chapter): self
    {
        if (!$this->chapters->contains($chapter)) {
            $this->chapters[] = $chapter;
            $chapter->setBook($this);
        }

        return $this;
    }

    public function removeChapter(Chapter $chapter): self
    {
        if ($this->chapters->removeElement($chapter)) {
            // set the owning side to null (unless already changed)
            if ($chapter->getBook() === $this) {
                $chapter->setBook(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getResources(): Collection
    {
        return $this->resources;
    }

    public function addResource(Resource $resource): self
    {
        if (!$this->resources->contains($resource)) {
            $this->resources[] = $resource;
            $resource->setBook($this);
        }

        return $this;
    }

    public function removeResource(Resource $resource): self
    {
        if ($this->resources->removeElement($resource)) {
            // set the owning side to null (unless already changed)
            if ($resource->getBook() === $this) {
                $resource->setBook(null);
            }
        }

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCoverFile(): ?File
    {
        return $this->coverFile;
    }

    public function setCoverFile(?File $coverFile = null): void
    {
        $this->coverFile = $coverFile;

        if (null !== $coverFile) {
            $datetime = new DateTimeImmutable();

            if (!$this->createdAt)
                $this->createdAt = $datetime;

            $this->updatedAt = $datetime;
        }
    }

    /**
     * @return string|null
     */
    public function getCoverName(): ?string
    {
        return $this->coverName;
    }

    /**
     * @param string|null $coverName
     */
    public function setCoverName(?string $coverName): void
    {
        $this->coverName = $coverName;
    }

    public function __toString(): ?string
    {
        return $this->getTitle();
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
}
