<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PressRepository")
 */
class Press
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Merci de renseigner le journal")
     * @Assert\Length(min = 1, max = 70, minMessage = "Le journal doit contenir au minimum {{ limit }} caractères", maxMessage = "Le journal doit contenir au maximum {{ limit }} caractères")
     */
    private $journal;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Merci de renseigner un contenu")
     * @Assert\Length(min = 5, max = 200, minMessage = "Le contenu doit contenir au minimum {{ limit }} caractères", maxMessage = "Le contenu doit contenir au maximum {{ limit }} caractères")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Albums", inversedBy="presses")
     */
    private $album;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJournal(): ?string
    {
        return $this->journal;
    }

    public function setJournal(string $journal): self
    {
        $this->journal = $journal;

        return $this;
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
