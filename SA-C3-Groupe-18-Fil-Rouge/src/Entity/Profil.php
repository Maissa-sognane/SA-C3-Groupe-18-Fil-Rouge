<?php

namespace App\Entity;

use App\Repository\ProfilRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ProfilRepository::class)
 * /**
 * @ApiResource(
 *     attributes={"security"="is_granted('ROLE_admin')"},
 *     collectionOperations={
 *         "get",
 *         "post"={"security"="is_granted('ROLE_admin')"}
 *     },
 *     itemOperations={
 *         "get",
 *         "put",
 *         "delete"={"security"="is_granted('ROLE_admin') or object.owner == user"},
 *     })
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
     *  * @Assert\NotBlank(
     *     message="Champ libelle vide"
     * )
     * @Groups({"profil:read_all"})
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
