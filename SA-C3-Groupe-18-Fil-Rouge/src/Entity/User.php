<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ApiResource(
 *     normalizationContext={"groups"={"profil:read","profil:read_all"}},
 *     attributes={"security"="is_granted('ROLE_admin')",
 *                  "security_message"="Vous n'avez pas access à cette Ressource"},
 *     collectionOperations={
 *     "get",
 *     "post",
 *     "get_simple"={
 *       "method"="GET",
 *       "path"="/admin/profils",
 *       "security"="is_granted('ROLE_admin')"
 *     },
 *     "post_simple"={
 *       "method"="POST",
 *       "path"="/admin/profils",
 *       "security"="is_granted('ROLE_admin')"
 *     },
 *     "get_apprenants"={
 *          "method"="GET",
 *          "path"="/apprenants" ,
 *          "normalization_context"={"groups":"apprenant:read"},
 *          "access_control"="(is_granted('ROLE_admin') or is_granted('ROLE_formateur'))",
 *          "access_control_message"="Vous n'avez pas access à cette Ressource",
 *          "route_name"="apprenant_liste",
 *     },
 *     },
 *     itemOperations={
 *         "get",
 *         "put"={"security"="is_granted('ROLE_admin')"},
 *     })
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"profil:read_all"})
     * @Groups({"apprenant:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank(
     *     message="Champ email vide"
     * )
     * @Assert\Email(
     *     message = "email invalid."
     * )
     * @Groups({"profil:read_all"})
     * @Groups({"apprenant:read"})
     */
    private $email;


    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\NotBlank(
     *     message="Champ Password vide"
     * )
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message="Champ prenom vide"
     * )
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Le prenom est invalid"
     * )
     * @Groups({"profil:read_all"})
     * @Groups({"apprenant:read"})
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message="Champ Nom vide"
     * )
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Le nom est invalid"
     * )
     * @Groups({"profil:read_all"})
     * @Groups({"apprenant:read"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"profil:read_all"})
     */
    private $avatar;

    /**
     * @ORM\ManyToOne(targetEntity=Profil::class, inversedBy="users")
     * @Assert\NotBlank(
     *     message="Champ profil vide"
     * )
     * @ApiSubresource
     * @Groups({"profil:read_all"})
     */
    private $profil;

    /**
     * @ORM\Column(type="blob", nullable=true)
     *
     */
    private $photo_avatar;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_'.$this->profil->getLibell();

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(?Profil $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    public function getPhotoAvatar()
    {
       //return \base64_encode(stream_get_contents($this->photo_avatar));
        return $this->photo_avatar;
    }

    public function setPhotoAvatar($photo_avatar): self
    {
        $this->photo_avatar = $photo_avatar;

        return $this;
    }
}
