<?php

namespace App\Entity;

use App\Entity\Traits\TimestampableTrait;
use App\Entity\Traits\UuidTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EntrenamientoRepository")
 */
class Entrenamiento
{
    use UuidTrait;
    use TimestampableTrait;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EntrenamientoLineas", mappedBy="entrenamiento", orphanRemoval=true)
     */
    private $lineas;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="entrenamientos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="HojaCuadernoRutina", inversedBy="entrenamientos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hoja_cuaderno_rutina;

    public function __construct()
    {
        $this->lineas = new ArrayCollection();
    }


    /**
     * @return Collection|EntrenamientoLineas[]
     */
    public function getLineas(): Collection
    {
        return $this->lineas;
    }

    public function addLinea(EntrenamientoLineas $linea): self
    {
        if (!$this->lineas->contains($linea)) {
            $this->lineas[] = $linea;
            $linea->setEntrenamiento($this);
        }

        return $this;
    }

    public function removeLinea(EntrenamientoLineas $linea): self
    {
        if ($this->lineas->contains($linea)) {
            $this->lineas->removeElement($linea);
            // set the owning side to null (unless already changed)
            if ($linea->getEntrenamiento() === $this) {
                $linea->setEntrenamiento(null);
            }
        }

        return $this;
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getHojaCuaderno(): ?HojaCuadernoRutina
    {
        return $this->hoja_cuaderno_rutina;
    }

    public function setHojaCuaderno(?HojaCuadernoRutina $hoja_cuaderno_rutina): self
    {
        $this->hoja_cuaderno_rutina = $hoja_cuaderno_rutina;

        return $this;
    }
}
