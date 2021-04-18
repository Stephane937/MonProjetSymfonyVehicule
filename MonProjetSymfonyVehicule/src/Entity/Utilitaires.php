<?php

namespace App\Entity;

use App\Repository\UtilitairesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UtilitairesRepository::class)
 */
class Utilitaires
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
    private $marqueU;

    /**
     * @ORM\Column(type="float")
     */
    private $prixU;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    public function __toString()
    {
        return $this->marqueU;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarqueU(): ?string
    {
        return $this->marqueU;
    }

    public function setMarqueU(string $marqueU): self
    {
        $this->marqueU = $marqueU;

        return $this;
    }

    public function getPrixU(): ?float
    {
        return $this->prixU;
    }

    public function setPrixU(float $prixU): self
    {
        $this->prixU = $prixU;

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
}
