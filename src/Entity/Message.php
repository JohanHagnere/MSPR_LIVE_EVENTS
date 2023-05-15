<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\OneToMany(mappedBy: 'message', targetEntity: Festival::class)]
    private Collection $festival_id;

    public function __construct()
    {
        $this->festival_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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

    /**
     * @return Collection<int, Festival>
     */
    public function getFestivalId(): Collection
    {
        return $this->festival_id;
    }

    public function addFestivalId(Festival $festivalId): self
    {
        if (!$this->festival_id->contains($festivalId)) {
            $this->festival_id->add($festivalId);
            $festivalId->setMessage($this);
        }

        return $this;
    }

    public function removeFestivalId(Festival $festivalId): self
    {
        if ($this->festival_id->removeElement($festivalId)) {
            // set the owning side to null (unless already changed)
            if ($festivalId->getMessage() === $this) {
                $festivalId->setMessage(null);
            }
        }

        return $this;
    }
}
