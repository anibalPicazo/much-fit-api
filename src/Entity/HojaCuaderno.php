<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HojaCuadernoRepository")
 */
class HojaCuaderno
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

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
     * @ORM\ManyToOne(targetEntity="Dieta", inversedBy="hojaCuadernos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Dieta;

    /**
     * @ORM\Column(type="json")
     */
    private $datos = [];

    public function __construct()
    {
        $this->entrenamientos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDieta(): ?Dieta
    {
        return $this->Dieta;
    }

    public function setDieta(?Dieta $Dieta): self
    {
        $this->Dieta = $Dieta;

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
}
