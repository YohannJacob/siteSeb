<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MakingOfRepository")
 */
class MakingOf
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $Content;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Albums", inversedBy="makingOf")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Album;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->Content;
    }

    public function setContent(string $Content): self
    {
        $this->Content = $Content;

        return $this;
    }

    public function getAlbum(): ?Albums
    {
        return $this->Album;
    }

    public function setAlbum(?Albums $Album): self
    {
        $this->Album = $Album;

        return $this;
    }
}
