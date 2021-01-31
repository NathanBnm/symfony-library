<?php

namespace App\Entity;

use App\Repository\SubscriptionRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SubscriptionRepository::class)
 */
class Subscription
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $subscriptionDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $renewalDate;

    /**
     * @ORM\ManyToOne(targetEntity=Book::class, inversedBy="subscriptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $book;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="subscriptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getSubscriptionDate(): ?DateTimeInterface
    {
        return $this->subscriptionDate;
    }

    /**
     * @param DateTimeInterface $subscriptionDate
     * @return $this
     */
    public function setSubscriptionDate(DateTimeInterface $subscriptionDate): self
    {
        $this->subscriptionDate = $subscriptionDate;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getRenewalDate(): ?DateTimeInterface
    {
        return $this->renewalDate;
    }

    /**
     * @param DateTimeInterface $renewalDate
     * @return $this
     */
    public function setRenewalDate(DateTimeInterface $renewalDate): self
    {
        $this->renewalDate = $renewalDate;

        return $this;
    }

    /**
     * @return Book|null
     */
    public function getBook(): ?Book
    {
        return $this->book;
    }

    /**
     * @param Book|null $book
     * @return $this
     */
    public function setBook(?Book $book): self
    {
        $this->book = $book;

        return $this;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     * @return $this
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
