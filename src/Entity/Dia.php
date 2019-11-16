<?php

namespace App\Entity;

use App\Entity\Traits\UuidTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;


/**
 * @ORM\Entity(repositoryClass="App\Repository\DiasRepository")
 * @Serializer\ExclusionPolicy("all")
 */
class Dia
{
    use UuidTrait;


    /**
     * @ORM\Column(type="string", length=10)
     * @Serializer\Groups({"list"})
     * @Serializer\Expose()
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DiaEjercicio", mappedBy="dia")
     * @Serializer\Groups({"list"})
     * @Serializer\Expose()
     */
    private $diaEjercicios;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rutina", inversedBy="dia")
     */
    private $rutina;

    public function __construct()
    {
        $this->diaEjercicios = new ArrayCollection();
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
            $diaEjercicio->setDia($this);
        }

        return $this;
    }

    public function removeDiaEjercicio(DiaEjercicio $diaEjercicio): self
    {
        if ($this->diaEjercicios->contains($diaEjercicio)) {
            $this->diaEjercicios->removeElement($diaEjercicio);
            // set the owning side to null (unless already changed)
            if ($diaEjercicio->getDia() === $this) {
                $diaEjercicio->setDia(null);
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
}
