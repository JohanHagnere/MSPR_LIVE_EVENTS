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
    private Collection $festival;

    public function __construct()
    {
        $this->festival = new ArrayCollection();
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
    public function getFestival(): Collection
    {
        return $this->festival;
    }

    public function addFestival(Festival $festival): self
    {
        if (!$this->festival->contains($festival)) {
            $this->festival->add($festival);
            $festival->setMessage($this);
        }

        return $this;
    }

    public function removeFestival(Festival $festival): self
    {
        if ($this->festival->removeElement($festival)) {
            // set the owning side to null (unless already changed)
            if ($festival->getMessage() === $this) {
                $festival->setMessage(null);
            }
        }

        return $this;
    }
}
