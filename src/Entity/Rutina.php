<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RutinaRepository")
 */
class Rutina
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Nombre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Dia", mappedBy="rutina")
     */
    private $Dia;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=3)
     */
    private $desgaste_calorico;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dificultad_usuario;

    /**
     * @ORM\Column(type="integer")
     */
    private $frecuencia;

    /**
     * @ORM\Column(type="integer")
     */
    private $volumen;

    /**
     * @ORM\Column(type="array")
     */
    private $objetivos = [];

    public function __construct()
    {
        $this->Dia = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(?string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    /**
     * @return Collection|Dia[]
     */
    public function getDia(): Collection
    {
        return $this->Dia;
    }

    public function addDium(Dia $dium): self
    {
        if (!$this->Dia->contains($dium)) {
            $this->Dia[] = $dium;
            $dium->setRutina($this);
        }

        return $this;
    }

    public function removeDium(Dia $dium): self
    {
        if ($this->Dia->contains($dium)) {
            $this->Dia->removeElement($dium);
            // set the owning side to null (unless already changed)
            if ($dium->getRutina() === $this) {
                $dium->setRutina(null);
            }
        }

        return $this;
    }

    public function getDesgasteCalorico()
    {
        return $this->desgaste_calorico;
    }

    public function setDesgasteCalorico($desgaste_calorico): self
    {
        $this->desgaste_calorico = $desgaste_calorico;

        return $this;
    }

    public function getDificultadUsuario(): ?string
    {
        return $this->dificultad_usuario;
    }

    public function setDificultadUsuario(string $dificultad_usuario): self
    {
        $this->dificultad_usuario = $dificultad_usuario;

        return $this;
    }

    public function getFrecuencia(): ?int
    {
        return $this->frecuencia;
    }

    public function setFrecuencia(int $frecuencia): self
    {
        $this->frecuencia = $frecuencia;

        return $this;
    }

    public function getVolumen(): ?int
    {
        return $this->volumen;
    }

    public function setVolumen(int $volumen): self
    {
        $this->volumen = $volumen;

        return $this;
    }

    public function getObjetivos(): ?array
    {
        return $this->objetivos;
    }

    public function setObjetivos(array $objetivos): self
    {
        $this->objetivos = $objetivos;

        return $this;
    }
}
