<?php

namespace App\Entity;

use App\Repository\ConcertRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConcertRepository::class)]
class Concert
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'concerts')]
    private ?Festival $performer = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $concert_date = null;

    #[ORM\ManyToMany(targetEntity: Festival::class, inversedBy: 'concerts')]
    private Collection $scene;

    public function __construct()
    {
        $this->scene = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPerformer(): ?Festival
    {
        return $this->performer;
    }

    public function setPerformer(?Festival $performer): self
    {
        $this->performer = $performer;

        return $this;
    }

    public function getConcertDate(): ?\DateTimeInterface
    {
        return $this->concert_date;
    }

    public function setConcertDate(\DateTimeInterface $concert_date): self
    {
        $this->concert_date = $concert_date;

        return $this;
    }

    /**
     * @return Collection<int, Festival>
     */
    public function getScene(): Collection
    {
        return $this->scene;
    }

    public function addScene(Festival $sceneId): self
    {
        if (!$this->scene->contains($sceneId)) {
            $this->scene->add($sceneId);
        }

        return $this;
    }

    public function removeScene(Festival $sceneId): self
    {
        $this->scene->removeElement($sceneId);

        return $this;
    }
}
