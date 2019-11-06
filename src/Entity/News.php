<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NewsRepository")
 * @Vich\Uploadable
 */
class News
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Merci de renseigner un titre")
     * @Assert\Length(min = 5, max = 30, minMessage = "Le titre de l'évènement doit contenir au minimum {{ limit }} caractères", maxMessage = "Le titre de l'évènement doit contenir au maximum {{ limit }} caractères")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Merci de renseigner un contenu")
     * @Assert\Length(min = 5, max = 550, minMessage = "Le contenu de l'évènement doit contenir au minimum {{ limit }} caractères", maxMessage = "Le contenu de l'évènement doit contenir au maximum {{ limit }} caractères")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ImageName;

    /**
     * @var File
     * @Vich\UploadableField(mapping="news_image", fileNameProperty="ImageName")
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Merci de choisir une image")
     * @Assert\Image(mimeTypes={"image/png", "image/jpeg", "image/jpg", "image/gif"})
     */
    private $ImageFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Date;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Merci de renseigner le lieu")
     * @Assert\Length(min = 5, max = 80, minMessage = "Le lieu de l'évènement doit contenir au minimum {{ limit }} caractères", maxMessage = "Le lieu de l'évènement doit contenir au maximum {{ limit }} caractères")
     */
    private $Place;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

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

    /**
     * @return File|UploadedFile
     */
    public function getImageFile()
    {
        return $this->ImageFile;
    }

    /**
     * @param null|string $ImageFile
     * @return News
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

    /**
     * @return null|string
     */
    public function getImageName()
    {
        return $this->ImageName;
    }

    /**
     * @param null|string $ImageName
     * @return News
     */
    public function setImageName($ImageName)
    {
        $this->ImageName = $ImageName;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->Place;
    }

    public function setPlace(string $Place): self
    {
        $this->Place = $Place;

        return $this;
    }
}
