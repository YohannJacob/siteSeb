<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
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
     * @ORM\OneToOne(targetEntity="App\Entity\MakingOf", mappedBy="album", cascade={"persist", "remove"})
     */
    private $makingOf;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Slider", mappedBy="album")
     */
    private $sliders;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Press", mappedBy="album")
     */
    private $presses;

   /**
     * @var File
     * @Vich\UploadableField(mapping="album_image", fileNameProperty="image1Name")
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Image(mimeTypes={"image/png", "image/jpeg", "image/jpg", "image/gif"})
     */
    private $image1File;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $image1Name;

   /**
     * @var File
     * @Vich\UploadableField(mapping="album_image", fileNameProperty="image2Name")
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Image(mimeTypes={"image/png", "image/jpeg", "image/jpg", "image/gif"})
     */
    private $image2File;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $image2Name;

   /**
     * @var File
     * @Vich\UploadableField(mapping="album_image", fileNameProperty="image3Name")
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Image(mimeTypes={"image/png", "image/jpeg", "image/jpg", "image/gif"})
     */
    private $image3File;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $image3Name;

   /**
     * @var File
     * @Vich\UploadableField(mapping="album_image", fileNameProperty="image4Name")
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Image(mimeTypes={"image/png", "image/jpeg", "image/jpg", "image/gif"})
     */
    private $image4File;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $image4Name;

   /**
     * @var File
     * @Vich\UploadableField(mapping="album_image", fileNameProperty="image5Name")
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Image(mimeTypes={"image/png", "image/jpeg", "image/jpg", "image/gif"})
     */
    private $image5File;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $image5Name;

   /**
     * @var File
     * @Vich\UploadableField(mapping="album_image", fileNameProperty="image6Name")
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Image(mimeTypes={"image/png", "image/jpeg", "image/jpg", "image/gif"})
     */
    private $image6File;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $image6Name;

   /**
     * @var File
     * @Vich\UploadableField(mapping="album_image", fileNameProperty="image7Name")
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Image(mimeTypes={"image/png", "image/jpeg", "image/jpg", "image/gif"})
     */
    private $image7File;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $image7Name;

    public function __construct()
    {
        $this->sliders = new ArrayCollection();
        $this->presses = new ArrayCollection();
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
    public function setCoverFile(?File $coverFile = null): void
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
    /**
     * @return Collection|Press[]
     */
    public function getPresses(): Collection
    {
        return $this->presses;
    }
    public function addPress(Press $press): self
    {
        if (!$this->presses->contains($press)) {
            $this->presses[] = $press;
            $press->setAlbum($this);
        }
        return $this;
    }
    public function removePress(Press $press): self
    {
        if ($this->presses->contains($press)) {
            $this->presses->removeElement($press);
            // set the owning side to null (unless already changed)
            if ($press->getAlbum() === $this) {
                $press->setAlbum(null);
            }
        }
        return $this;
    }

    /**
     * @return File|UploadedFile
     */
    public function getImage1File()
    {
        return $this->image1File;
    }

    public function setImage1File(?File $image1File = null): void
    {
        $this->image1File = $image1File;
        if (null !== $image1File) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }
    
    /**
     * @return null|string
     */
    public function getImage1Name()
    {
        return $this->image1Name;
    }
    /**
     * @param null|string $image1Name
     * @return Albums
     */
    public function setImage1Name($image1Name)
    {
        $this->image1Name = $image1Name;

        return $this;
    }
    /**
     * @return File|UploadedFile
     */
    public function getImage2File()
    {
        return $this->image2File;
    }

    public function setImage2File(?File $image2File = null): void
    {
        $this->image2File = $image2File;
        if (null !== $image2File) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    /**
     * @return null|string
     */
    public function getImage2Name()
    {
        return $this->image2Name;
    }
    /**
     * @param null|string $image2Name
     * @return Albums
     */
    public function setImage2Name($image2Name)
    {
        $this->image2Name = $image2Name;

        return $this;
    }
    /**
     * @return File|UploadedFile
     */
    public function getImage3File()
    {
        return $this->image3File;
    }

    public function setImage3File(?File $image3File = null): void
    {
        $this->image3File = $image3File;
        if (null !== $image3File) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }
    /**
     * @return null|string
     */
    public function getImage3Name()
    {
        return $this->image3Name;
    }
    /**
     * @param null|string $image3Name
     * @return Albums
     */
    public function setImage3Name($image3Name)
    {
        $this->image3Name = $image3Name;

        return $this;
    }
    /**
     * @return File|UploadedFile
     */
    public function getImage4File()
    {
        return $this->image4File;
    }

    public function setImage4File(?File $image4File = null): void
    {
        $this->image4File = $image4File;
        if (null !== $image4File) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }
    /**
     * @return null|string
     */
    public function getImage4Name()
    {
        return $this->image4Name;
    }
    /**
     * @param null|string $image4Name
     * @return Albums
     */
    public function setImage4Name($image4Name)
    {
        $this->image4Name = $image4Name;

        return $this;
    }
    /**
     * @return File|UploadedFile
     */
    public function getImage5File()
    {
        return $this->image5File;
    }

    public function setImage5File(?File $image5File = null): void
    {
        $this->image5File = $image5File;
        if (null !== $image5File) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }
    /**
     * @return null|string
     */
    public function getImage5Name(): ?string
    {
        return $this->image5Name;
    }
    /**
     * @param null|string $image5Name
     * @return Albums
     */
    public function setImage5Name($image5Name)
    {
        $this->image5Name = $image5Name;

        return $this;
    }
    /**
     * @return File|UploadedFile
     */
    public function getImage6File()
    {
        return $this->image6File;
    }

    public function setImage6File(?File $image6File = null): void
    {
        $this->image6File = $image6File;
        if (null !== $image6File) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }
    /**
     * @return null|string
     */
    public function getImage6Name()
    {
        return $this->image6Name;
    }
    /**
     * @param null|string $image6Name
     * @return Albums
     */
    public function setImage6Name($image6Name)
    {
        $this->image6Name = $image6Name;

        return $this;
    }
    /**
     * @return File|UploadedFile
     */
    public function getImage7File()
    {
        return $this->image7File;
    }

    public function setImage7File(?File $image7File = null): void
    {
        $this->image7File = $image7File;
        if (null !== $image7File) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }
    /**
     * @return null|string
     */
    public function getImage7Name()
    {
        return $this->image7Name;
    }
    /**
     * @param null|string $image7Name
     * @return Albums
     */
    public function setImage7Name($image7Name)
    {
        $this->image7Name = $image7Name;

        return $this;
    }

    public function getImage8file(): ?string
    {
        return $this->Image8file;
    }

    public function setImage8file(?string $Image8file): self
    {
        $this->Image8file = $Image8file;

        return $this;
    }
}
