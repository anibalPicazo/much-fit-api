<?php

namespace App\Entity;

use App\Entity\Traits\UuidTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DiaEjercicioRepository")
 */
class DiaEjercicio
{
    use UuidTrait;

    /**
     * @ORM\ManyToOne(targetEntity="Dia", inversedBy="diaEjercicios")
     */
    private $dia;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $serie;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $repeticiones;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $descanso;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ejercicios", inversedBy="diaEjercicios")
     */
    private $ejercicio;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=2, nullable=true)
     */
    private $intensidad;


    public function getDia(): ?Dia
    {
        return $this->dia;
    }

    public function setDia(?Dia $dia): self
    {
        $this->dia = $dia;

        return $this;
    }

    public function getSerie(): ?string
    {
        return $this->serie;
    }

    public function setSeries(?string $serie): self
    {
        $this->serie = $serie;

        return $this;
    }

    public function getRepeticiones(): ?int
    {
        return $this->repeticiones;
    }

    public function setRepeticiones(?int $repeticiones): self
    {
        $this->repeticiones = $repeticiones;

        return $this;
    }

    public function getDescanso(): ?int
    {
        return $this->descanso;
    }

    public function setDescanso(?int $descanso): self
    {
        $this->descanso = $descanso;

        return $this;
    }

    public function getEjercicio(): ?Ejercicios
    {
        return $this->ejercicio;
    }

    public function setEjercicio(?Ejercicios $ejercicio): self
    {
        $this->ejercicio = $ejercicio;

        return $this;
    }

    public function getIntensidad()
    {
        return $this->intensidad;
    }

    public function setIntensidad($intensidad): self
    {
        $this->intensidad = $intensidad;

        return $this;
    }
}
