<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * /**
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
class User
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
     * @ORM\Column(type="string", length=255)
     * * @Assert\NotBlank(
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
     * /**
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
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     *  /**
     * @var string The hashed password
     * @Assert\NotBlank(
     *     message="Champ Password vide"
     * )
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatar;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $profil;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="profil")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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

    public function getProfil(): ?self
    {
        return $this->profil;
    }

    public function setProfil(?self $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(self $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setProfil($this);
        }

        return $this;
    }

    public function removeUser(self $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getProfil() === $this) {
                $user->setProfil(null);
            }
        }

        return $this;
    }
}
