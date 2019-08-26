<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HojaCuadernoDietaRepository")
 */
class HojaCuadernoDieta
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="CuadernoEntrenamiento", inversedBy="hojaCuadernoDietas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cuaderno;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCuaderno(): ?CuadernoEntrenamiento
    {
        return $this->cuaderno;
    }

    public function setCuaderno(?CuadernoEntrenamiento $cuaderno): self
    {
        $this->cuaderno = $cuaderno;

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
}
