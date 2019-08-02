<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TestUsuarioRepository")
 */
class TestUsuario
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="testUsuario", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sendentarismo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adherencia_deporte;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adherencia_dieta;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=3)
     */
    private $porcentaje_grasa;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=3)
     */
    private $peso;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=3)
     */
    private $altura;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $composicion_atletica;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $frecuencia_entrenamiento;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $experiencia_deporte;

    /**
     * @ORM\Column(type="boolean")
     */
    private $diabetico;

    /**
     * @ORM\Column(type="boolean")
     */
    private $celiaco;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $genero;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $diasEntrenamiento = [];

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSendentarismo(): ?bool
    {
        return $this->sendentarismo;
    }

    public function setSendentarismo(bool $sendentarismo): self
    {
        $this->sendentarismo = $sendentarismo;

        return $this;
    }

    public function getAdherenciaDeporte(): ?string
    {
        return $this->adherencia_deporte;
    }

    public function setAdherenciaDeporte(string $adherencia_deporte): self
    {
        $this->adherencia_deporte = $adherencia_deporte;

        return $this;
    }

    public function getAdherenciaDieta(): ?string
    {
        return $this->adherencia_dieta;
    }

    public function setAdherenciaDieta(string $adherencia_dieta): self
    {
        $this->adherencia_dieta = $adherencia_dieta;

        return $this;
    }

    public function getPorcentajeGrasa()
    {
        return $this->porcentaje_grasa;
    }

    public function setPorcentajeGrasa($porcentaje_grasa): self
    {
        $this->porcentaje_grasa = $porcentaje_grasa;

        return $this;
    }

    public function getPeso()
    {
        return $this->peso;
    }

    public function setPeso($peso): self
    {
        $this->peso = $peso;

        return $this;
    }

    public function getAltura()
    {
        return $this->altura;
    }

    public function setAltura($altura): self
    {
        $this->altura = $altura;

        return $this;
    }

    public function getComposicionAtletica(): ?string
    {
        return $this->composicion_atletica;
    }

    public function setComposicionAtletica(string $composicion_atletica): self
    {
        $this->composicion_atletica = $composicion_atletica;

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

    public function getDiabetico(): ?bool
    {
        return $this->diabetico;
    }

    public function setDiabetico(bool $diabetico): self
    {
        $this->diabetico = $diabetico;

        return $this;
    }

    public function getCeliaco(): ?bool
    {
        return $this->celiaco;
    }

    public function setCeliaco(bool $celiaco): self
    {
        $this->celiaco = $celiaco;

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
}
