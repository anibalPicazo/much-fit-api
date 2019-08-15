<?php

namespace App\Entity;

use App\Entity\Traits\TimestampableTrait;
use App\Entity\Traits\UuidTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TestUsuarioRepository")
 */
class TestUsuario
{

    use TimestampableTrait;
    use UuidTrait;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="testUsuario", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $frecuencia_entrenamiento;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $experiencia_deporte;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $genero;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $diasEntrenamiento = [];

    /**
     * @ORM\Column(type="integer")
     */
    private $edad;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $forma_fisica;


    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
    public function getFrecuenciaEntrenamiento(): ?string
    {
        return $this->frecuencia_entrenamiento;
    }

    public function setFrecuenciaEntrenamiento(string $frecuencia_entrenamiento): self
    {
        $this->frecuencia_entrenamiento = $frecuencia_entrenamiento;

        return $this;
    }

    public function getExperienciaDeporte(): ?string
    {
        return $this->experiencia_deporte;
    }

    public function setExperienciaDeporte(string $experiencia_deporte): self
    {
        $this->experiencia_deporte = $experiencia_deporte;

        return $this;
    }



    public function getGenero(): ?string
    {
        return $this->genero;
    }

    public function setGenero(string $genero): self
    {
        $this->genero = $genero;

        return $this;
    }

    public function getDiasEntrenamiento(): ?array
    {
        return $this->diasEntrenamiento;
    }

    public function setDiasEntrenamiento(?array $diasEntrenamiento): self
    {
        $this->diasEntrenamiento = $diasEntrenamiento;

        return $this;
    }

    public function getFormaFisica(): ?string
    {
        return $this->forma_fisica;
    }

    public function setFormaFisica(string $forma_fisica): self
    {
        $this->forma_fisica = $forma_fisica;

        return $this;
    }

}
