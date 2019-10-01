<?php

namespace App\Entity;

use App\Entity\Traits\UuidTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DietaRepository")
 */
class Dieta
{
    use UuidTrait;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=2)
     */
    private $aporte_calorico_diario;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $proteina;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nivel_carbohidratos;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nivel_grasas;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\HojaCuadernoDieta", mappedBy="dieta", orphanRemoval=true)
     */
    private $hojaCuadernoDietas;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DiaDieta", mappedBy="dieta")
     */
    private $dias_dieta;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="dieta")
     */
    private $user;

    public function __construct()
    {
        $this->hojaCuadernoDietas = new ArrayCollection();
        $this->dias_dieta = new ArrayCollection();
        $this->user = new ArrayCollection();
    }
    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }
    public function getAporteCaloricoDiario()
    {
        return $this->aporte_calorico_diario;
    }

    public function setAporteCaloricoDiario($aporte_calorico_diario): self
    {
        $this->aporte_calorico_diario = $aporte_calorico_diario;

        return $this;
    }

    public function getProteina(): ?string
    {
        return $this->proteina;
    }

    public function setProteina(string $proteina): self
    {
        $this->proteina = $proteina;

        return $this;
    }

    public function getNivelCarbohidratos(): ?string
    {
        return $this->nivel_carbohidratos;
    }

    public function setNivelCarbohidratos(string $nivel_carbohidratos): self
    {
        $this->nivel_carbohidratos = $nivel_carbohidratos;

        return $this;
    }

    public function getNivelGrasas(): ?string
    {
        return $this->nivel_grasas;
    }

    public function setNivelGrasas(string $nivel_grasas): self
    {
        $this->nivel_grasas = $nivel_grasas;

        return $this;
    }


    /**
     * @return Collection|HojaCuadernoDieta[]
     */
    public function getHojaCuadernoDietas(): Collection
    {
        return $this->hojaCuadernoDietas;
    }

    public function addHojaCuadernoDieta(HojaCuadernoDieta $hojaCuadernoDieta): self
    {
        if (!$this->hojaCuadernoDietas->contains($hojaCuadernoDieta)) {
            $this->hojaCuadernoDietas[] = $hojaCuadernoDieta;
            $hojaCuadernoDieta->setDieta($this);
        }

        return $this;
    }

    public function removeHojaCuadernoDieta(HojaCuadernoDieta $hojaCuadernoDieta): self
    {
        if ($this->hojaCuadernoDietas->contains($hojaCuadernoDieta)) {
            $this->hojaCuadernoDietas->removeElement($hojaCuadernoDieta);
            // set the owning side to null (unless already changed)
            if ($hojaCuadernoDieta->getDieta() === $this) {
                $hojaCuadernoDieta->setDieta(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DiaDieta[]
     */
    public function getDiasDieta(): Collection
    {
        return $this->dias_dieta;
    }

    public function addDiasDietum(DiaDieta $diasDietum): self
    {
        if (!$this->dias_dieta->contains($diasDietum)) {
            $this->dias_dieta[] = $diasDietum;
            $diasDietum->setDieta($this);
        }

        return $this;
    }

    public function removeDiasDietum(DiaDieta $diasDietum): self
    {
        if ($this->dias_dieta->contains($diasDietum)) {
            $this->dias_dieta->removeElement($diasDietum);
            // set the owning side to null (unless already changed)
            if ($diasDietum->getDieta() === $this) {
                $diasDietum->setDieta(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
            $user->setDieta($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getDieta() === $this) {
                $user->setDieta(null);
            }
        }

        return $this;
    }
}
