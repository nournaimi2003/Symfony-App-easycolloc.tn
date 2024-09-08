<?php

namespace App\Entity;

use App\Repository\OffreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OffreRepository::class)
 */
class Offre
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
    private $type_offre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     */
    private $date_creation;

    /**
     * @ORM\Column(type="float")
     */
    private $surface;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $animaux;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $femeur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $meuble;

    /**
     * @ORM\Column(type="integer")
     */
    private $numeroTel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     */
    private $coloc_occup;

    /**
     * @ORM\ManyToOne(targetEntity=Region::class, inversedBy="offre")
     */
    private $region;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeOffre(): ?string
    {
        return $this->type_offre;
    }

    public function setTypeOffre(string $type_offre): self
    {
        $this->type_offre = $type_offre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getSurface(): ?float
    {
        return $this->surface;
    }

    public function setSurface(float $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getAnimaux(): ?string
    {
        return $this->animaux;
    }

    public function setAnimaux(string $animaux): self
    {
        $this->animaux = $animaux;

        return $this;
    }

    public function getFemeur(): ?string
    {
        return $this->femeur;
    }

    public function setFemeur(string $femeur): self
    {
        $this->femeur = $femeur;

        return $this;
    }

    public function getMeuble(): ?string
    {
        return $this->meuble;
    }

    public function setMeuble(string $meuble): self
    {
        $this->meuble = $meuble;

        return $this;
    }

    public function getNumeroTel(): ?int
    {
        return $this->numeroTel;
    }

    public function setNumeroTel(int $numeroTel): self
    {
        $this->numeroTel = $numeroTel;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage( $image)
    {
        $this->image = $image;

        return $this;
    }

    public function getColocOccup(): ?int
    {
        return $this->coloc_occup;
    }

    public function setColocOccup(int $coloc_occup): self
    {
        $this->coloc_occup = $coloc_occup;

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

        return $this;
    }
}
