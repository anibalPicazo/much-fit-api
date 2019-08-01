<?php

namespace App\Entity;

use App\Entity\Traits\UuidTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoleRepository")
 * @Serializer\ExclusionPolicy("all")
 * @UniqueEntity("name")
 */
class Role
{
    const ROLE_ROOT = 'ROLE_ROOT';
    const ROLE_AUDITOR_ADMIN = 'ROLE_AUDITOR_ADMIN';
    const ROLE_AUDITOR = 'ROLE_AUDITOR';
    const ROLE_AUDITOR_FREELANCE = 'ROLE_AUDITOR_FREELANCE';
    const ROLE_CLIENT = 'ROLE_CLIENT';
    const ROLE_USER = 'ROLE_USER';

    use TimestampableEntity;
    use UuidTrait;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"list"})
     * @Serializer\Expose()
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Role", inversedBy="roles")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Role", mappedBy="parent")
     */
    private $roles;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="roles")
     */
    private $users;


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function addRole(self $role): self
    {
        if (!$this->roles->contains($role)) {
            $this->roles[] = $role;
            $role->setParent($this);
        }

        return $this;
    }

    public function removeRole(self $role): self
    {
        if ($this->roles->contains($role)) {
            $this->roles->removeElement($role);
            // set the owning side to null (unless already changed)
            if ($role->getParent() === $this) {
                $role->setParent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addRole($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            $user->removeRole($this);
        }

        return $this;
    }
}
