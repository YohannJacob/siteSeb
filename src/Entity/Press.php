<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PressRepository")
 * @Vich\Uploadable
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
     * @ORM\Column(type="string", length=255)
     */
    private $ImageName;

    /**
     * @var File
     * @Vich\UploadableField(mapping="press_image", fileNameProperty="ImageName")
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Image(mimeTypes={"image/png", "image/jpeg", "image/jpg", "image/gif"})
     */
    private $ImageFile;

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

    /**
     * @return null|string
     */
    public function getImageName()
    {
        return $this->ImageName;
    }

    /**
     * @param null|string $ImageName
     * @return Detail
     */
    public function setImageName($ImageName)
    {
        $this->ImageName = $ImageName;
        return $this;
    }

    /**
     * @return File|UploadedFile
     */
    public function getImageFile()
    {
        return $this->ImageFile;
    }

    /**
     * @param null|string $ImageFile
     * @return Detail
     */

    public function setImageFile(?File $ImageFile= null) : void
    {
        $this->ImageFile = $ImageFile;

        if (null !== $ImageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }
}
