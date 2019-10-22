<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AlbumsRepository")
 * @Vich\Uploadable
 * @ORM\Entity
 */
class Albums
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * * @Assert\Length(
     *      min = 2,
     *      max = 70,
     *      minMessage = "Le titre de l'album dit contenir au minimum {{ limit }} caractères",
     *      maxMessage = "Le titre de l'album dit contenir au maximum {{ limit }} caractères"
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Subtitle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Scenario;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Dessin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Couleur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $buyLink;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @var string|null 
     * @ORM\Column(type="string", length=255)
     */
    private $coverName;

    /**
     * @var File
     * @Vich\UploadableField(mapping="cover_image", fileNameProperty="coverName")
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Image(mimeTypes={"image/png", "image/jpeg", "image/jpg", "image/gif"})
     */
    private $coverFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\MakingOf", mappedBy="album", orphanRemoval=true)
     */
    private $makingOf;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Slider", mappedBy="album", orphanRemoval=true)
     */
    private $sliders;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Press", mappedBy="album", orphanRemoval=true)
     */
    private $presses;

    public function __construct()
    {
        $this->sliders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSubtitle(): ?string
    {
        return $this->Subtitle;
    }

    public function setSubtitle(string $Subtitle): self
    {
        $this->Subtitle = $Subtitle;

        return $this;
    }

    public function getScenario(): ?string
    {
        return $this->Scenario;
    }

    public function setScenario(string $Scenario): self
    {
        $this->Scenario = $Scenario;

        return $this;
    }

    public function getDessin(): ?string
    {
        return $this->Dessin;
    }

    public function setDessin(string $Dessin): self
    {
        $this->Dessin = $Dessin;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->Couleur;
    }

    public function setCouleur(string $Couleur): self
    {
        $this->Couleur = $Couleur;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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
    public function getCoverFile()
    {
        return $this->coverFile;
    }

    /**
     * @param null|string $coverFile
     * @return Albums
     */

    public function setCoverFile(?File $coverFile= null) : void
    {
        $this->coverFile = $coverFile;

        if (null !== $coverFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }
    /**
     * @return null|string
     */

    public function getCoverName()
    {
        return $this->coverName;
    }

    /**
     * @param null|string $coverName
     * @return Albums
     */
    public function setCoverName($coverName)
    {
        $this->coverName = $coverName;
        return $this;
    }

    public function getBuyLink(): ?string
    {
        return $this->buyLink;
    }

    public function setBuyLink(string $buyLink): self
    {
        $this->buyLink = $buyLink;

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

    public function getMakingOf(): ?MakingOf
    {
        return $this->makingOf;
    }

    public function setMakingOf(?MakingOf $makingOf): self
    {
        $this->makingOf = $makingOf;

        // set (or unset) the owning side of the relation if necessary
        $newAlbum = $makingOf === null ? null : $this;
        if ($newAlbum !== $makingOf->getAlbum()) {
            $makingOf->setAlbum($newAlbum);
        }

        return $this;
    }


    public function getPresses(): ?Press
    {
        return $this->presses;
    }

    public function setPress(?Press $presses): self
    {
        $this->makingOf = $presses;

        // set (or unset) the owning side of the relation if necessary
        $newAlbum = $presses === null ? null : $this;
        if ($newAlbum !== $presses->getAlbum()) {
            $presses->setAlbum($newAlbum);
        }

        return $this;
    }


    /**
     * @return Collection|Slider[]
     */
    public function getSliders(): Collection
    {
        return $this->sliders;
    }

    public function addSlider(Slider $slider): self
    {
        if (!$this->sliders->contains($slider)) {
            $this->sliders[] = $slider;
            $slider->setAlbum($this);
        }

        return $this;
    }

    public function removeSlider(Slider $slider): self
    {
        if ($this->sliders->contains($slider)) {
            $this->sliders->removeElement($slider);
            // set the owning side to null (unless already changed)
            if ($slider->getAlbum() === $this) {
                $slider->setAlbum(null);
            }
        }

        return $this;
    }
}
