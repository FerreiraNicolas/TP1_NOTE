<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VisiteRepository")
 */
class Visite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $suite;

 

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Bien")
     */
    private $id_bien;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Visiteur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $visiteur;

    public function __construct()
    {
        $this->id_visiteur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSuite(): ?string
    {
        return $this->suite;
    }

    public function setSuite(?string $suite): self
    {
        $this->suite = $suite;

        return $this;
    }

    /**
     * @return Collection|Visiteur[]
     */
    public function getIdVisiteur(): Collection
    {
        return $this->id_visiteur;
    }

    public function addIdVisiteur(Visiteur $idVisiteur): self
    {
        if (!$this->id_visiteur->contains($idVisiteur)) {
            $this->id_visiteur[] = $idVisiteur;
        }

        return $this;
    }

    public function removeIdVisiteur(Visiteur $idVisiteur): self
    {
        if ($this->id_visiteur->contains($idVisiteur)) {
            $this->id_visiteur->removeElement($idVisiteur);
        }

        return $this;
    }

    public function getIdBien(): ?Bien
    {
        return $this->id_bien;
    }

    public function setIdBien(?Bien $id_bien): self
    {
        $this->id_bien = $id_bien;

        return $this;
    }

    public function getVisiteur(): ?Visiteur
    {
        return $this->visiteur;
    }

    public function setVisiteur(?Visiteur $visiteur): self
    {
        $this->visiteur = $visiteur;

        return $this;
    }
}
