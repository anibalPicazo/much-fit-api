<?php

namespace App\Entity;

use App\Entity\Traits\UuidTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RutinaRepository")
 */
class Rutina
{
    use UuidTrait;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Nombre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Dia", mappedBy="rutina")
     */
    private $dia;

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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="rutina")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="HojaCuadernoRutina", mappedBy="rutina", orphanRemoval=true)
     */
    private $hojas_cuaderno_rutina;

    public function __construct()
    {
        $this->dia = new ArrayCollection();
        $this->user = new ArrayCollection();
        $this->hojas_cuaderno_rutina = new ArrayCollection();
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
        return $this->dia;
    }

    public function addDium(dia $dium): self
    {
        if (!$this->dia->contains($dium)) {
            $this->dia[] = $dium;
            $dium->setRutina($this);
        }

        return $this;
    }

    public function removeDium(dia $dium): self
    {
        if ($this->dia->contains($dium)) {
            $this->dia->removeElement($dium);
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

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
            $user->setRutina($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getRutina() === $this) {
                $user->setRutina(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|HojaCuadernoRutina[]
     */
    public function getHojaCuadernosRutina(): Collection
    {
        return $this->hojas_cuaderno_rutina;
    }

    public function addHojaCuadernoRutina(HojaCuadernoRutina $hoja_cuaderno_rutina): self
    {
        if (!$this->hojas_cuaderno_rutina->contains($hoja_cuaderno_rutina)) {
            $this->hojas_cuaderno_rutina[] = $hoja_cuaderno_rutina;
            $hoja_cuaderno_rutina->setRutina($this);
        }

        return $this;
    }

    public function removeHojaCuadernoRutina(HojaCuadernoRutina $hoja_cuaderno_rutina): self
    {
        if ($this->hojas_cuaderno_rutina->contains($hoja_cuaderno_rutina)) {
            $this->hojas_cuaderno_rutina->removeElement($hoja_cuaderno_rutina);
            // set the owning side to null (unless already changed)
            if ($hoja_cuaderno_rutina->getRutina() === $this) {
                $hoja_cuaderno_rutina->setRutina(null);
            }
        }

        return $this;
    }
}
