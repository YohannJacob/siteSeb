<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SliderRepository")
 * @Vich\Uploadable
 */
class Slider
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ImageName;

    /**
     * @var File
     * @Vich\UploadableField(mapping="slider_image", fileNameProperty="ImageName")
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Image(mimeTypes={"image/png", "image/jpeg", "image/jpg", "image/gif"})
     */
    private $ImageFile;

   /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SubTitle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Position;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Albums", inversedBy="sliders")
     */
    private $album;

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Slider
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
     * @return Slider
     */
    public function setImageName($ImageName)
    {
        $this->ImageName = $ImageName;
        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getSubTitle(): ?string
    {
        return $this->SubTitle;
    }

    public function setSubTitle(string $SubTitle): self
    {
        $this->SubTitle = $SubTitle;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->Position;
    }

    public function setPosition(string $Position): self
    {
        $this->Position = $Position;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

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
