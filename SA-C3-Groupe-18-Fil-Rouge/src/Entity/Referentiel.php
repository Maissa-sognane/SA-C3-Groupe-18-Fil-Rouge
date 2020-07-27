<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ReferentielRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ReferentielRepository::class)
 */
class Referentiel
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
    private $libelle;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $presentation;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $competenceVisee;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $programme;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $critereEvaluation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $critereAdmission;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $admission;

    /**
     * @ORM\ManyToMany(targetEntity=groupeCompetence::class, inversedBy="referentiels")
     */
    private $referentiel;

    /**
     * @ORM\OneToMany(targetEntity=promotion::class, mappedBy="referentiel")
     */
    private $referentielPromo;

    public function __construct()
    {
        $this->referentiel = new ArrayCollection();
        $this->referentielPromo = new ArrayCollection();
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

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(?string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getCompetenceVisee(): ?string
    {
        return $this->competenceVisee;
    }

    public function setCompetenceVisee(?string $competenceVisee): self
    {
        $this->competenceVisee = $competenceVisee;

        return $this;
    }

    public function getProgramme(): ?string
    {
        return $this->programme;
    }

    public function setProgramme(?string $programme): self
    {
        $this->programme = $programme;

        return $this;
    }

    public function getCritereEvaluation(): ?string
    {
        return $this->critereEvaluation;
    }

    public function setCritereEvaluation(string $critereEvaluation): self
    {
        $this->critereEvaluation = $critereEvaluation;

        return $this;
    }

    public function getCritereAdmission(): ?string
    {
        return $this->critereAdmission;
    }

    public function setCritereAdmission(string $critereAdmission): self
    {
        $this->critereAdmission = $critereAdmission;

        return $this;
    }

    public function getAdmission(): ?string
    {
        return $this->admission;
    }

    public function setAdmission(string $admission): self
    {
        $this->admission = $admission;

        return $this;
    }

    /**
     * @return Collection|groupeCompetence[]
     */
    public function getReferentiel(): Collection
    {
        return $this->referentiel;
    }

    public function addReferentiel(groupeCompetence $referentiel): self
    {
        if (!$this->referentiel->contains($referentiel)) {
            $this->referentiel[] = $referentiel;
        }

        return $this;
    }

    public function removeReferentiel(groupeCompetence $referentiel): self
    {
        if ($this->referentiel->contains($referentiel)) {
            $this->referentiel->removeElement($referentiel);
        }

        return $this;
    }

    /**
     * @return Collection|promotion[]
     */
    public function getReferentielPromo(): Collection
    {
        return $this->referentielPromo;
    }

    public function addReferentielPromo(promotion $referentielPromo): self
    {
        if (!$this->referentielPromo->contains($referentielPromo)) {
            $this->referentielPromo[] = $referentielPromo;
            $referentielPromo->setReferentiel($this);
        }

        return $this;
    }

    public function removeReferentielPromo(promotion $referentielPromo): self
    {
        if ($this->referentielPromo->contains($referentielPromo)) {
            $this->referentielPromo->removeElement($referentielPromo);
            // set the owning side to null (unless already changed)
            if ($referentielPromo->getReferentiel() === $this) {
                $referentielPromo->setReferentiel(null);
            }
        }

        return $this;
    }
}
