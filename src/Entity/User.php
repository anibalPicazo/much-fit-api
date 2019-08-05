<?php

namespace App\Entity;

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
 * @Serializer\ExclusionPolicy("all")
 * @UniqueEntity(
 *     fields={"username","email"},
 *     errorPath="email",
 *     message="The email is already in use."
 * )
 */
class User implements UserInterface
{

    use TimestampableEntity;
    use UuidTrait;

    public function __construct()
    {
        $this->setActivo(true);
        $this->roles = new ArrayCollection();
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
     * @Serializer\Expose()
     */
    private $activo;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Role", inversedBy="users")
     * @Serializer\Groups({"edit"})
     * @Serializer\Expose()
     */
    private $roles;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\DietaPersonalizada", mappedBy="usuario", cascade={"persist", "remove"})
     */
    private $dietaPersonalizada;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\TestUsuario", mappedBy="user", cascade={"persist", "remove"})
     */
    private $testUsuario;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\CuardernoEntrenamiento", mappedBy="usuario", cascade={"persist", "remove"})
     */
    private $cuardernoEntrenamiento;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=3, nullable=true)
     */
    private $metabolismo_basal;

    /**
     * @ORM\Column(type="integer")
     */
    private $edad;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $objetivo;




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

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(bool $activo): self
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * @return array[]
     */
    public function getRoles(): array
    {
        $stringyfiedRoles = [];

        foreach ($this->roles as $role){
            $stringyfiedRoles[] = $role->getName();
        }

        return $stringyfiedRoles;
    }

    public function addRole(Role $role): self
    {
        if (!$this->roles->contains($role)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    public function removeRole(Role $role): self
    {
        if ($this->roles->contains($role)) {
            $this->roles->removeElement($role);
        }

        return $this;
    }

    public function getDietaPersonalizada(): ?DietaPersonalizada
    {
        return $this->dietaPersonalizada;
    }

    public function setDietaPersonalizada(?DietaPersonalizada $dietaPersonalizada): self
    {
        $this->dietaPersonalizada = $dietaPersonalizada;

        // set (or unset) the owning side of the relation if necessary
        $newUsuario = $dietaPersonalizada === null ? null : $this;
        if ($newUsuario !== $dietaPersonalizada->getUsuario()) {
            $dietaPersonalizada->setUsuario($newUsuario);
        }

        return $this;
    }

    public function getTestUsuario(): ?TestUsuario
    {
        return $this->testUsuario;
    }

    public function setTestUsuario(?TestUsuario $testUsuario): self
    {
        $this->testUsuario = $testUsuario;

        // set (or unset) the owning side of the relation if necessary
        $newUser = $testUsuario === null ? null : $this;
        if ($newUser !== $testUsuario->getUser()) {
            $testUsuario->setUser($newUser);
        }

        return $this;
    }

    public function getCuardernoEntrenamiento(): ?CuardernoEntrenamiento
    {
        return $this->cuardernoEntrenamiento;
    }

    public function setCuardernoEntrenamiento(CuardernoEntrenamiento $cuardernoEntrenamiento): self
    {
        $this->cuardernoEntrenamiento = $cuardernoEntrenamiento;

        // set the owning side of the relation if necessary
        if ($this !== $cuardernoEntrenamiento->getUsuario()) {
            $cuardernoEntrenamiento->setUsuario($this);
        }

        return $this;
    }

    public function getMetabolismoBasal()
    {
        return $this->metabolismo_basal;
    }

    public function setMetabolismoBasal($metabolismo_basal): self
    {
        $this->metabolismo_basal = $metabolismo_basal;

        return $this;
    }

    public function getEdad(): ?int
    {
        return $this->edad;
    }

    public function setEdad(int $edad): self
    {
        $this->edad = $edad;

        return $this;
    }

    public function getObjetivo(): ?string
    {
        return $this->objetivo;
    }

    public function setObjetivo(string $objetivo): self
    {
        $this->objetivo = $objetivo;

        return $this;
    }




}
