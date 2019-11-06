<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank(message="Merci de renseigner un contenu")
     * @Assert\Length(min = 5, minMessage = "Le contenu doit contenir au minimum {{ limit }} caractères")
     */
    private $Content;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Albums", inversedBy="makingOf", cascade={"persist", "remove"})
     */
    private $album;

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
        return $this->album;
    }

    public function setAlbum(?Albums $album): self
    {
        $this->album = $album;

        return $this;
    }
}
