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
     * @ORM\ManyToOne(targetEntity="App\Entity\HojaCuaderno", inversedBy="entrenamientos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hojaCuaderno;

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

    public function getHojaCuaderno(): ?HojaCuaderno
    {
        return $this->hojaCuaderno;
    }

    public function setHojaCuaderno(?HojaCuaderno $hojaCuaderno): self
    {
        $this->hojaCuaderno = $hojaCuaderno;

        return $this;
    }
}
