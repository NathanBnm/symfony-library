<?php

namespace App\Entity;

use App\Repository\SectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SectionRepository::class)
 */
class Section
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Chapter::class, inversedBy="sections")
     * @ORM\JoinColumn(nullable=true)
     */
    private $chapter;

    /**
     * @ORM\ManyToOne(targetEntity=Section::class, inversedBy="sections")
     * @ORM\JoinColumn(nullable=true)
     */
    private $section;

    /**
     * @ORM\OneToMany(targetEntity=Section::class, mappedBy="section")
     */
    private $sections;

    /**
     * @ORM\OneToMany(targetEntity=Resource::class, mappedBy="section")
     */
    private $resources;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * Section constructor.
     */
    public function __construct()
    {
        $this->sections = new ArrayCollection();
        $this->resources = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Chapter|null
     */
    public function getChapter(): ?Chapter
    {
        return $this->chapter;
    }

    /**
     * @param Chapter|null $chapter
     * @return $this
     */
    public function setChapter(?Chapter $chapter): self
    {
        $this->chapter = $chapter;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getSections(): Collection
    {
        return $this->sections;
    }

    /**
     * @param Section $section
     * @return $this
     */
    public function addSection(self $section): self
    {
        if (!$this->sections->contains($section)) {
            $this->sections[] = $section;
            $section->setSection($this);
        }

        return $this;
    }

    /**
     * @param Section $section
     * @return $this
     */
    public function removeSection(self $section): self
    {
        if ($this->sections->removeElement($section)) {
            // set the owning side to null (unless already changed)
            if ($section->getSection() === $this) {
                $section->setSection(null);
            }
        }

        return $this;
    }

    /**
     * @return $this|null
     */
    public function getSection(): ?self
    {
        return $this->section;
    }

    /**
     * @param Section|null $section
     * @return $this
     */
    public function setSection(?self $section): self
    {
        $this->section = $section;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getResources(): Collection
    {
        return $this->resources;
    }

    /**
     * @param Resource $resource
     * @return $this
     */
    public function addResource(Resource $resource): self
    {
        if (!$this->resources->contains($resource)) {
            $this->resources[] = $resource;
            $resource->setSection($this);
        }

        return $this;
    }

    /**
     * @param Resource $resource
     * @return $this
     */
    public function removeResource(Resource $resource): self
    {
        if ($this->resources->removeElement($resource)) {
            // set the owning side to null (unless already changed)
            if ($resource->getSection() === $this) {
                $resource->setSection(null);
            }
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function __toString(): ?string
    {
        return $this->getTitle();
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
}
