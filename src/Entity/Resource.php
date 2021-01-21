<?php

namespace App\Entity;

use App\Repository\ResourceRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ResourceRepository::class)
 * @Vich\Uploadable
 */
class Resource extends Favorite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Book::class, inversedBy="resources")
     */
    private $book;

    /**
     * @ORM\ManyToOne(targetEntity=Chapter::class, inversedBy="resources")
     */
    private $chapter;

    /**
     * @ORM\ManyToOne(targetEntity=Section::class, inversedBy="resources")
     */
    private $section;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

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
     * @Vich\UploadableField(mapping="file", fileNameProperty="fileName")
     *
     * @var File|null
     */
    private $file;

    /**
     * @ORM\Column(type="string")
     *
     * @var string|null
     */
    private $fileName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(?Book $book): self
    {
        $this->book = $book;

        return $this;
    }

    public function getChapter(): ?Chapter
    {
        return $this->chapter;
    }

    public function setChapter(?Chapter $chapter): self
    {
        $this->chapter = $chapter;

        return $this;
    }

    public function getSection(): ?Section
    {
        return $this->section;
    }

    public function setSection(?Section $section): self
    {
        $this->section = $section;

        return $this;
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

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(?File $file = null): void
    {
        $this->file = $file;

        if (null !== $file) {
            $datetime = new DateTimeImmutable();

            if (!$this->createdAt)
                $this->createdAt = $datetime;

            $this->updatedAt = $datetime;
        }
    }

    /**
     * @return string|null
     */
    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    /**
     * @param string|null $fileName
     */
    public function setFileName(?string $fileName): void
    {
        $this->fileName = $fileName;
    }

    public function __toString(): ?string
    {
        return $this->getTitle();
    }
}
