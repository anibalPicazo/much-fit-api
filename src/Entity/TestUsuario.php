<?php

namespace App\Entity;

use App\Entity\Traits\TimestampableTrait;
use App\Entity\Traits\UuidTrait;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;


/**
 * @ORM\Entity(repositoryClass="App\Repository\TestUsuarioRepository")
 * @Serializer\ExclusionPolicy("all")
 */
class TestUsuario
{

    use TimestampableTrait;
    use UuidTrait;


    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"list"})
     * @Serializer\Expose()
     */
    private $frecuencia_entrenamiento;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"list"})
     * @Serializer\Expose()
     */
    private $experiencia_deporte;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"list"})
     * @Serializer\Expose()
     */
    private $forma_fisica;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="testUsuario", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @Serializer\Groups({"list"})
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Serializer\Expose()
     */
    private $objetivo;



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

    public function getFormaFisica(): ?string
    {
        return $this->forma_fisica;
    }

    public function setFormaFisica(string $forma_fisica): self
    {
        $this->forma_fisica = $forma_fisica;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getObjetivo(): ?string
    {
        return $this->objetivo;
    }

    public function setObjetivo(?string $objetivo): self
    {
        $this->objetivo = $objetivo;

        return $this;
    }

}
