<?php

namespace App\Entity;

use App\Repository\ReservationCampRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationCampRepository::class)
 */
class ReservationCamp
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
    private $ville;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDepart;

    /**
     * @ORM\Column(type="date")
     */
    private $dateRetour;

    /**
     * @ORM\OneToOne(targetEntity=CampingCar::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Campingcars;

    /**
     * @ORM\OneToOne(targetEntity=Utilisateur::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $utilisateurs;

    public function __toString()
    {
        return $this->ville;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->dateDepart;
    }

    public function setDateDepart(\DateTimeInterface $dateDepart): self
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    public function getDateRetour(): ?\DateTimeInterface
    {
        return $this->dateRetour;
    }

    public function setDateRetour(\DateTimeInterface $dateRetour): self
    {
        $this->dateRetour = $dateRetour;

        return $this;
    }

    public function getCampingcars(): ?CampingCar
    {
        return $this->Campingcars;
    }

    public function setCampingcars(CampingCar $Campingcars): self
    {
        $this->Campingcars = $Campingcars;

        return $this;
    }

    public function getUtilisateurs(): ?Utilisateur
    {
        return $this->utilisateurs;
    }

    public function setUtilisateurs(Utilisateur $utilisateurs): self
    {
        $this->utilisateurs = $utilisateurs;

        return $this;
    }
}
