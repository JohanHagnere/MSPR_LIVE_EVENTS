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
    private ?Festival $performer_id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $concert_date = null;

    #[ORM\ManyToMany(targetEntity: Festival::class, inversedBy: 'concerts')]
    private Collection $scene_id;

    public function __construct()
    {
        $this->scene_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPerformerId(): ?Festival
    {
        return $this->performer_id;
    }

    public function setPerformerId(?Festival $performer_id): self
    {
        $this->performer_id = $performer_id;

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
    public function getSceneId(): Collection
    {
        return $this->scene_id;
    }

    public function addSceneId(Festival $sceneId): self
    {
        if (!$this->scene_id->contains($sceneId)) {
            $this->scene_id->add($sceneId);
        }

        return $this;
    }

    public function removeSceneId(Festival $sceneId): self
    {
        $this->scene_id->removeElement($sceneId);

        return $this;
    }
}
