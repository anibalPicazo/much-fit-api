<?php

namespace App\Entity;

use App\Entity\Traits\UuidTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HojaCuadernoDietaRepository")
 */
class HojaCuadernoDieta
{
    use UuidTrait;

    /**
     * @ORM\ManyToOne(targetEntity="CuadernoEntrenamiento", inversedBy="hojas_cuaderno_dietas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cuaderno_entrenamiento;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Dieta", inversedBy="hojaCuadernoDietas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dieta;

    /**
     * @ORM\Column(type="json")
     */
    private $datos = [];

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $fecha_inicio;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fecha_fin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DietaPersonalizada")
     */
    private $dieta_personalizada;

    public function getCuaderno(): ?CuadernoEntrenamiento
    {
        return $this->cuaderno_entrenamiento;
    }

    public function setCuaderno(?CuadernoEntrenamiento $cuaderno_entrenamiento): self
    {
        $this->cuaderno_entrenamiento = $cuaderno_entrenamiento;

        return $this;
    }

    public function getDieta(): ?Dieta
    {
        return $this->dieta;
    }

    public function setDieta(?Dieta $dieta): self
    {
        $this->dieta = $dieta;

        return $this;
    }

    public function getDatos(): ?array
    {
        return $this->datos;
    }

    public function setDatos(array $datos): self
    {
        $this->datos = $datos;

        return $this;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fecha_inicio;
    }

    public function setFechaInicio(\DateTimeInterface $fecha_inicio): self
    {
        $this->fecha_inicio = $fecha_inicio;

        return $this;
    }

    public function getFechaFin(): ?\DateTimeInterface
    {
        return $this->fecha_fin;
    }

    public function setFechaFin(?\DateTimeInterface $fecha_fin): self
    {
        $this->fecha_fin = $fecha_fin;

        return $this;
    }

    public function getDietaPersonalizada(): ?DietaPersonalizada
    {
        return $this->dieta_personalizada;
    }

    public function setDietaPersonalizada(?DietaPersonalizada $dieta_personalizada): self
    {
        $this->dieta_personalizada = $dieta_personalizada;

        return $this;
    }
}
