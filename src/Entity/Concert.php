<?php

namespace App\Entity;

use App\Repository\ConcertRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConcertRepository::class)]
class Concert
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $concert_date = null;

    #[ORM\ManyToOne(inversedBy: 'concerts')]
    private ?Scene $scene = null;

    #[ORM\ManyToOne(inversedBy: 'concerts')]
    private ?Performer $performer = null;


    public function getId(): ?int
    {
        return $this->id;
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

  

    public function getScene(): ?Scene
    {
        return $this->scene;
    }

    public function setScene(?Scene $scene): self
    {
        $this->scene = $scene;

        return $this;
    }

    public function getPerformer(): ?Performer
    {
        return $this->performer;
    }

    public function setPerformer(?Performer $performer): self
    {
        $this->performer = $performer;

        return $this;
    }
}
