<?php

namespace App\Entity;

use App\Repository\ProfilRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProfilRepository::class)
 */
class Profil
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
    private $libell;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibell(): ?string
    {
        return $this->libell;
    }

    public function setLibell(string $libell): self
    {
        $this->libell = $libell;

        return $this;
    }
}
