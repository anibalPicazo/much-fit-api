<?php

namespace App\Entity;

use App\Entity\Traits\TimestampableTrait;
use App\Entity\Traits\UuidTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HojaCuadernoRepository")
 */
class HojaCuadernoRutina
{
    use UuidTrait;
    use TimestampableTrait;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Entrenamiento", mappedBy="hojaCuaderno", orphanRemoval=true)
     */
    private $entrenamientos;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rutina", inversedBy="hojaCuadernos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rutina;



    /**
     * @ORM\Column(type="json")
     */
    private $datos = [];

    /**
     * @ORM\ManyToOne(targetEntity="CuadernoEntrenamiento", inversedBy="hojas_cuaderno_rutina")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cuaderno_entrenamiento;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $hasta;

    /**
     * @ORM\Column(type="datetime")
     */
    private $desde;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fecha_fin;

    /**
     * @ORM\Column(type="boolean")
     */
    private $actual;

    public function __construct()
    {
        $this->entrenamientos = new ArrayCollection();
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
            $entrenamiento->setHojaCuaderno($this);
        }

        return $this;
    }

    public function removeEntrenamiento(Entrenamiento $entrenamiento): self
    {
        if ($this->entrenamientos->contains($entrenamiento)) {
            $this->entrenamientos->removeElement($entrenamiento);
            // set the owning side to null (unless already changed)
            if ($entrenamiento->getHojaCuaderno() === $this) {
                $entrenamiento->setHojaCuaderno(null);
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

    public function getDatos(): ?array
    {
        return $this->datos;
    }

    public function setDatos(array $datos): self
    {
        $this->datos = $datos;

        return $this;
    }

    public function getCuardernoEntrenamiento(): ?CuadernoEntrenamiento
    {
        return $this->cuaderno_entrenamiento;
    }

    public function setCuardernoEntrenamiento(?CuadernoEntrenamiento $cuaderno_entrenamiento): self
    {
        $this->cuaderno_entrenamiento = $cuaderno_entrenamiento;

        return $this;
    }

    public function getHasta(): ?\DateTimeInterface
    {
        return $this->hasta;
    }

    public function setHasta(\DateTimeInterface $hasta): self
    {
        $this->hasta = $hasta;

        return $this;
    }

    public function getDesde(): ?\DateTimeInterface
    {
        return $this->desde;
    }

    public function setDesde(\DateTimeInterface $desde): self
    {
        $this->desde = $desde;

        return $this;
    }

    public function getFechaFin(): ?\DateTimeInterface
    {
        return $this->fecha_fin;
    }

    public function setFechaFin(?\DateTimeInterface $fecha_fin): self
    {
        $this->fecha_fin = $fecha_fin;

        return $this;
    }

    public function getActual(): ?bool
    {
        return $this->actual;
    }

    public function setActual(bool $actual): self
    {
        $this->actual = $actual;

        return $this;
    }
}
