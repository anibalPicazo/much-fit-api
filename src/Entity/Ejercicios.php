<?php

namespace App\Entity;

use App\Entity\Traits\UuidTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;


/**
 * @ORM\Entity(repositoryClass="App\Repository\EjerciciosRepository")
 * @Serializer\ExclusionPolicy("all")
 */
class Ejercicios
{

    use UuidTrait;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Serializer\Groups({"list"})
     * @Serializer\Expose()
     */
    private $descripcion;



    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DiaEjercicio", mappedBy="ejercicio")
     */
    private $diaEjercicios;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EntrenamientoLineas", mappedBy="ejercicio")
     */
    private $entrenamientoLineas;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imagen;



    public function __construct()
    {
        $this->diaEjercicios = new ArrayCollection();
        $this->entrenamientoLineas = new ArrayCollection();
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }



    /**
     * @return Collection|DiaEjercicio[]
     */
    public function getDiaEjercicios(): Collection
    {
        return $this->diaEjercicios;
    }

    public function addDiaEjercicio(DiaEjercicio $diaEjercicio): self
    {
        if (!$this->diaEjercicios->contains($diaEjercicio)) {
            $this->diaEjercicios[] = $diaEjercicio;
            $diaEjercicio->setEjercicio($this);
        }

        return $this;
    }

    public function removeDiaEjercicio(DiaEjercicio $diaEjercicio): self
    {
        if ($this->diaEjercicios->contains($diaEjercicio)) {
            $this->diaEjercicios->removeElement($diaEjercicio);
            // set the owning side to null (unless already changed)
            if ($diaEjercicio->getEjercicio() === $this) {
                $diaEjercicio->setEjercicio(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|EntrenamientoLineas[]
     */
    public function getEntrenamientoLineas(): Collection
    {
        return $this->entrenamientoLineas;
    }

    public function addEntrenamientoLinea(EntrenamientoLineas $entrenamientoLinea): self
    {
        if (!$this->entrenamientoLineas->contains($entrenamientoLinea)) {
            $this->entrenamientoLineas[] = $entrenamientoLinea;
            $entrenamientoLinea->setEjercicio($this);
        }

        return $this;
    }

    public function removeEntrenamientoLinea(EntrenamientoLineas $entrenamientoLinea): self
    {
        if ($this->entrenamientoLineas->contains($entrenamientoLinea)) {
            $this->entrenamientoLineas->removeElement($entrenamientoLinea);
            // set the owning side to null (unless already changed)
            if ($entrenamientoLinea->getEjercicio() === $this) {
                $entrenamientoLinea->setEjercicio(null);
            }
        }

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(string $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

}
