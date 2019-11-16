<?php

namespace App\Entity;

use App\Entity\Traits\TimestampableTrait;
use App\Entity\Traits\UuidTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @Serializer\ExclusionPolicy("none")
 * @UniqueEntity(
 *     fields={"username","email"},
 *     errorPath="email",
 *     message="The email is already in use."
 * )
 */
class User implements UserInterface
{

    use TimestampableTrait;
    use UuidTrait;

    public function __construct()
    {
        $this->setActivo(true);
        $this->roles = new ArrayCollection();
        $this->entrenamientos = new ArrayCollection();
        $this->testUsuarioDietas = new ArrayCollection();
    }

    /**
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     * @Serializer\Groups({"list"})
     * @Serializer\Expose()
     */
    protected $username;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"list"})
     * @Serializer\Expose()
     */
    private $email;

    /**
     * @ORM\Column(type="boolean", options={"default":true})
     * @Serializer\Expose()
     * @Serializer\Groups({"list"})
     */
    private $activo;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Role",cascade={"persist"})
     * @Serializer\Expose()
     */
    private $roles;

    /**
     * @ORM\OneToOne(targetEntity="CuadernoEntrenamiento", mappedBy="usuario", cascade={"persist", "remove"})
     */
    private $cuardernoEntrenamiento;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $surname;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\TestUsuario", mappedBy="user", cascade={"persist", "remove"})
     */
    private $testUsuario;

    /**
     * @Serializer\Type("array")
     * @Serializer\VirtualProperty()
     * @Serializer\SerializedName("test_usuario")
     * @Serializer\Groups({"list"})
     * @Serializer\Expose()
     */
    public function vpTestUsuario()
    {
        if($this->testUsuario){
            return [
                'uuid' => $this->testUsuario->getUuid(),
                'created_at' => $this->testUsuario->getCreatedAt()
            ];
        }
        return null;
    }

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Entrenamiento", mappedBy="user", orphanRemoval=true)
     */
    private $entrenamientos;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rutina", inversedBy="user")
     * @Serializer\Expose()
     * @Serializer\Groups({"edit"})
     */
    private $rutina;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TestUsuarioDieta", mappedBy="user", orphanRemoval=true)
     */
    private $testUsuarioDietas;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Dieta", inversedBy="user")
     * @Serializer\Groups({"edit"})
     */
    private $dieta;

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     * @return self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    public function getSalt()
    {

    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string)$this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = null;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    public function getActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(bool $activo)
    {
        $this->activo = $activo;

        return $this;
    }

    public function getRoles(): array
    {
        $rolesPlain = [];
        /** @var Role $role */
        foreach ($this->roles as $role) {
            $rolesPlain = $rolesPlain + $this->buildTree($role, $role->getChildren());
        }
        return array_values($rolesPlain);
    }


    public function buildTree(Role $role, $children)
    {
        $tree[$role->getUuid()] = $role->getName();
        foreach ($children as $role) {
            $tree = $tree + $this->buildTree($role, $role->getChildren());
        }
        return $tree;
    }

    public function addRole(Role $role): self
    {
        if (!$this->roles->contains($role)) {
            $this->roles[] = $role;
//            $children = $role->getChildren();
//            $this->roles = $this->buildTree($role, $children);
        }
        return $this;
    }

    public function removeRole(Role $role): self
    {
        if ($this->roles->contains($role)) {
            $this->roles->removeElement($role);
//            $this->updateRoles();
        }

        return $this;
    }

//    public function updateRoles()
//    {
//        /** @var Role $role */
//        foreach ($this->getRolesObj() as $role) {
//            $roles = $role->getChildren();
//            array_walk_recursive($roles, function ($role, $key) {
//            });
//        }
//    }

    public function getRolesObj()
    {
        return $this->roles;
    }



    public function getCuardernoEntrenamiento(): ?CuadernoEntrenamiento
    {
        return $this->cuardernoEntrenamiento;
    }

    public function setCuardernoEntrenamiento(CuadernoEntrenamiento $cuardernoEntrenamiento): self
    {
        $this->cuardernoEntrenamiento = $cuardernoEntrenamiento;

        // set the owning side of the relation if necessary
        if ($this !== $cuardernoEntrenamiento->getUsuario()) {
            $cuardernoEntrenamiento->setUsuario($this);
        }

        return $this;
    }


    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getTestUsuario(): ?TestUsuario
    {
        return $this->testUsuario;
    }

    public function setTestUsuario(TestUsuario $testUsuario): self
    {
        $this->testUsuario = $testUsuario;

        // set the owning side of the relation if necessary
        if ($this !== $testUsuario->getUser()) {
            $testUsuario->setUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|Entrenamiento[]
     */
    public function getEntrenamientos(): Collection
    {
        return $this->entrenamientos;
    }

    public function addEntrenamiento(Entrenamiento $entrenamiento): self
    {
        if (!$this->entrenamientos->contains($entrenamiento)) {
            $this->entrenamientos[] = $entrenamiento;
            $entrenamiento->setUser($this);
        }

        return $this;
    }

    public function removeEntrenamiento(Entrenamiento $entrenamiento): self
    {
        if ($this->entrenamientos->contains($entrenamiento)) {
            $this->entrenamientos->removeElement($entrenamiento);
            // set the owning side to null (unless already changed)
            if ($entrenamiento->getUser() === $this) {
                $entrenamiento->setUser(null);
            }
        }

        return $this;
    }

    public function getRutina(): ?Rutina
    {
        return $this->rutina;
    }

    public function setRutina(?Rutina $rutina): self
    {
        $this->rutina = $rutina;

        return $this;
    }

    /**
     * @return Collection|TestUsuarioDieta[]
     */
    public function getTestUsuarioDietas(): Collection
    {
        return $this->testUsuarioDietas;
    }

    public function addTestUsuarioDieta(TestUsuarioDieta $testUsuarioDieta): self
    {
        if (!$this->testUsuarioDietas->contains($testUsuarioDieta)) {
            $this->testUsuarioDietas[] = $testUsuarioDieta;
            $testUsuarioDieta->setUser($this);
        }

        return $this;
    }

    public function removeTestUsuarioDieta(TestUsuarioDieta $testUsuarioDieta): self
    {
        if ($this->testUsuarioDietas->contains($testUsuarioDieta)) {
            $this->testUsuarioDietas->removeElement($testUsuarioDieta);
            // set the owning side to null (unless already changed)
            if ($testUsuarioDieta->getUser() === $this) {
                $testUsuarioDieta->setUser(null);
            }
        }

        return $this;
    }

    public function getDieta(): ?Dieta
    {
        return $this->dieta;
    }

    public function setDieta(?Dieta $dieta): self
    {
        $this->dieta = $dieta;

        return $this;
    }

}
