<?php

namespace App\Entity;

use App\Repository\RegionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RegionRepository::class)
 */
class Region
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=Offre::class, mappedBy="region")
     */
    private $offre;

    public function __construct()
    {
        $this->offre = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Offre>
     */
    public function getOffre(): Collection
    {
        return $this->offre;
    }

    public function addOffre(Offre $offre): self
    {
        if (!$this->offre->contains($offre)) {
            $this->offre[] = $offre;
            $offre->setRegion($this);
        }

        return $this;
    }

    public function removeOffre(Offre $offre): self
    {
        if ($this->offre->removeElement($offre)) {
            // set the owning side to null (unless already changed)
            if ($offre->getRegion() === $this) {
                $offre->setRegion(null);
            }
        }

        return $this;
    }
}
