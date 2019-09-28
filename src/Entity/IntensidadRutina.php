<?php

namespace App\Entity;

use App\Entity\Traits\UuidTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IntensidadRutinaRepository")
 */
class IntensidadRutina
{

    use UuidTrait;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rutina", mappedBy="intensidad")
     */
    private $rutinas;

    public function __construct()
    {
        $this->rutinas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
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
     * @return Collection|Rutina[]
     */
    public function getRutinas(): Collection
    {
        return $this->rutinas;
    }

    public function addRutina(Rutina $rutina): self
    {
        if (!$this->rutinas->contains($rutina)) {
            $this->rutinas[] = $rutina;
            $rutina->setIntensidad($this);
        }

        return $this;
    }

    public function removeRutina(Rutina $rutina): self
    {
        if ($this->rutinas->contains($rutina)) {
            $this->rutinas->removeElement($rutina);
            // set the owning side to null (unless already changed)
            if ($rutina->getIntensidad() === $this) {
                $rutina->setIntensidad(null);
            }
        }

        return $this;
    }
}
