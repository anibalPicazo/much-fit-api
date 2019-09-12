<?php

namespace App\Entity;

use App\Entity\Traits\UuidTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GrupoMuscularRepository")
 */
class GrupoMuscular
{
    use UuidTrait;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ejercicios", mappedBy="grupo_muscular")
     */
    private $ejercicios;

    public function __construct()
    {
        $this->ejercicios = new ArrayCollection();
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
     * @return Collection|Ejercicios[]
     */
    public function getEjercicios(): Collection
    {
        return $this->ejercicios;
    }

    public function addEjercicio(Ejercicios $ejercicio): self
    {
        if (!$this->ejercicios->contains($ejercicio)) {
            $this->ejercicios[] = $ejercicio;
            $ejercicio->addGrupoMuscular($this);
        }

        return $this;
    }

    public function removeEjercicio(Ejercicios $ejercicio): self
    {
        if ($this->ejercicios->contains($ejercicio)) {
            $this->ejercicios->removeElement($ejercicio);
            $ejercicio->removeGrupoMuscular($this);
        }

        return $this;
    }
}
