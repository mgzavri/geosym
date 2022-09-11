<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Entity\File;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;

#[ORM\Entity(repositoryClass: ArtistRepository::class), Uploadable]
class Artist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;


    #[UploadableField(mapping: 'image', fileNameProperty: 'image')]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string', length: 255)]
    private $name_ru;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $name_ge;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $name_en;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $name_fr;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description_ru;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description_ge;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description_en;

    #[ORM\OneToMany(mappedBy: 'artist', targetEntity: Picture::class)]
    private $picture;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated_at = null;

    public function __construct()
    {
        $this->picture = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameRu(): ?string
    {
        return $this->name_ru;
    }

    public function setNameRu(string $name_ru): self
    {
        $this->name_ru = $name_ru;

        return $this;
    }

    public function getNameGe(): ?string
    {
        return $this->name_ge;
    }

    public function setNameGe(?string $name_ge): self
    {
        $this->name_ge = $name_ge;

        return $this;
    }

    public function getNameEn(): ?string
    {
        return $this->name_en;
    }

    public function setNameEn(?string $name_en): self
    {
        $this->name_en = $name_en;

        return $this;
    }

    public function getNameFr(): ?string
    {
        return $this->name_fr;
    }

    public function setNameFr(?string $name_fr): self
    {
        $this->name_fr = $name_fr;

        return $this;
    }

    public function getDescriptionRu(): ?string
    {
        return $this->description_ru;
    }

    public function setDescriptionRu(?string $description_ru): self
    {
        $this->description_ru = $description_ru;

        return $this;
    }

    public function getDescriptionGe(): ?string
    {
        return $this->description_ge;
    }

    public function setDescriptionGe(?string $description_ge): self
    {
        $this->description_ge = $description_ge;

        return $this;
    }

    public function getDescriptionEn(): ?string
    {
        return $this->description_en;
    }

    public function setDescriptionEn(?string $description_en): self
    {
        $this->description_en = $description_en;

        return $this;
    }

    /**
     * @return Collection<int, Picture>
     */
    public function getPicture(): Collection
    {
        return $this->picture;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->picture->contains($picture)) {
            $this->picture[] = $picture;
            $picture->setArtist($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->picture->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getArtist() === $this) {
                $picture->setArtist(null);
            }
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param mixed $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;
        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updated_at = new \DateTimeImmutable();
        }
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
