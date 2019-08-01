<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EntrenamientoRepository")
 */
class Entrenamiento
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EntrenamientoLineas", mappedBy="entrenamiento", orphanRemoval=true)
     */
    private $lineas;

    public function __construct()
    {
        $this->lineas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
}
