<?php

namespace App\Entity;

use App\Entity\Traits\TimestampableTrait;
use App\Entity\Traits\UuidTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CuardernoEntrenamientoRepository")
 */
class CuadernoEntrenamiento
{
    use UuidTrait;
    use TimestampableTrait;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="cuardernoEntrenamiento", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario;

    /**
     * @ORM\OneToMany(targetEntity="HojaCuadernoRutina", mappedBy="cuaderno_entrenamiento", orphanRemoval=true)
     */
    private $hojas_cuaderno_rutina;

    /**
     * @ORM\OneToMany(targetEntity="HojaCuadernoDieta", mappedBy="cuaderno_entrenamiento", orphanRemoval=true)
     */
    private $hojas_cuaderno_dietas;

    public function __construct()
    {
        $this->hojas_cuaderno_rutina = new ArrayCollection();
        $this->hojas_cuaderno_dietas = new ArrayCollection();
    }

    public function getUsuario(): ?User
    {
        return $this->usuario;
    }

    public function setUsuario(User $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * @return Collection|HojaCuadernoRutina[]
     */
    public function getHojasEntrenamiento(): Collection
    {
        return $this->hojas_cuaderno_rutina;
    }

    public function addHojaEntrenamientoRutina(HojaCuadernoRutina $hoja_cuaderno_rutina): self
    {
        if (!$this->hojas_cuaderno_rutina->contains($hoja_cuaderno_rutina)) {
            $this->hojas_cuaderno_rutina[] = $hoja_cuaderno_rutina;
            $hoja_cuaderno_rutina->setCuardernoEntrenamiento($this);
        }

        return $this;
    }

    public function removeHojaEntrenamientoRutina(HojaCuadernoRutina $hoja_cuaderno_rutina): self
    {
        if ($this->hojas_cuaderno_rutina->contains($hoja_cuaderno_rutina)) {
            $this->hojas_cuaderno_rutina->removeElement($hoja_cuaderno_rutina);
            // set the owning side to null (unless already changed)
            if ($hoja_cuaderno_rutina->getCuardernoEntrenamiento() === $this) {
                $hoja_cuaderno_rutina->setCuardernoEntrenamiento(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|HojaCuadernoDieta[]
     */
    public function getHojaCuadernoDietas(): Collection
    {
        return $this->hojas_cuaderno_dietas;
    }

    public function addHojaCuadernoDieta(HojaCuadernoDieta $hoja_cuaderno_dieta): self
    {
        if (!$this->hojas_cuaderno_dietas->contains($hoja_cuaderno_dieta)) {
            $this->hojas_cuaderno_dietas[] = $hoja_cuaderno_dieta;
            $hoja_cuaderno_dieta->setCuaderno($this);
        }

        return $this;
    }

    public function removeHojaCuadernoDieta(HojaCuadernoDieta $hojas_cuaderno_dieta): self
    {
        if ($this->hojas_cuaderno_dietas->contains($hojas_cuaderno_dieta)) {
            $this->hojas_cuaderno_dietas->removeElement($hojas_cuaderno_dieta);
            // set the owning side to null (unless already changed)
            if ($hojas_cuaderno_dieta->getCuaderno() === $this) {
                $hojas_cuaderno_dieta->setCuaderno(null);
            }
        }

        return $this;
    }


}
