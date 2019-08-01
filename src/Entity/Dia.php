<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DiasRepository")
 */
class Dia
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DiaEjercicio", mappedBy="dia")
     */
    private $diaEjercicios;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rutina", inversedBy="Dia")
     */
    private $rutina;

    public function __construct()
    {
        $this->diaEjercicios = new ArrayCollection();
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
