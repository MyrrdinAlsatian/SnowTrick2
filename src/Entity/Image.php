<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $path = null;

    #[ORM\ManyToMany(targetEntity: Tricks::class, inversedBy: 'images')]
    private Collection $trick;

    #[ORM\OneToOne(mappedBy: 'FeatureImage', cascade: ['persist'])]
    private ?Tricks $feature = null;

    public function __construct()
    {
        $this->trick = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return Collection<int, Tricks>
     */
    public function getTrick(): Collection
    {
        return $this->trick;
    }

    public function addTrick(Tricks $trick): self
    {
        if (!$this->trick->contains($trick)) {
            $this->trick->add($trick);
        }

        return $this;
    }

    public function removeTrick(Tricks $trick): self
    {
        $this->trick->removeElement($trick);

        return $this;
    }

    public function __toString()
    {
        return $this->path;
    }

    public function getFeature(): ?Tricks
    {
        return $this->feature;
    }

    public function setFeature(?Tricks $feature): self
    {
        // unset the owning side of the relation if necessary
        if ($feature === null && $this->feature !== null) {
            $this->feature->setFeatureImage(null);
        }

        // set the owning side of the relation if necessary
        if ($feature !== null && $feature->getFeatureImage() !== $this) {
            $feature->setFeatureImage($this);
        }

        $this->feature = $feature;

        return $this;
    }
}
