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

    /**
     * @ORM\Column(type="decimal", precision=6, scale=3, nullable=true)
     */
    private $imc;

    /**
     * @ORM\Column(type="integer")
     */
    private $edad;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TipoFisico", inversedBy="usuarios_composion_atletica_comienzo")
     * @ORM\JoinColumn(nullable=false)
     */
    private $composicon_atletica;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TipoFisico", inversedBy="usuario_composicon_atletica_objetivo")
     * @ORM\JoinColumn(nullable=false)
     */
    private $composicion_atletica_objetivo;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=3)
     */
    private $metabolismo_basal;

    public function __construct()
    {
        if($this->getGenero() == "MUJER"){
            $this->imc = (10 * $this->getPeso())+(6.25 * $this->getAltura()) - (5 * $this->getEdad()) - 161 ;
        }
        elseif ($this->getGenero() == "MUJER") $this->imc = (10 * $this->getPeso())+(6.25 * $this->getAltura()) - (5 * $this->getEdad()) + 5;
    }

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

    public function getImc()
    {
        return $this->imc;
    }

    public function setImc($imc): self
    {
        $this->imc = $imc;

        return $this;
    }

    public function getEdad(): ?int
    {
        return $this->edad;
    }

    public function setEdad(int $edad): self
    {
        $this->edad = $edad;

        return $this;
    }

    public function getComposiconAtletica(): ?TipoFisico
    {
        return $this->composicon_atletica;
    }

    public function setComposiconAtletica(?TipoFisico $composicon_atletica): self
    {
        $this->composicon_atletica = $composicon_atletica;

        return $this;
    }

    public function getComposicionAtleticaObjetivo(): ?TipoFisico
    {
        return $this->composicion_atletica_objetivo;
    }

    public function setComposicionAtleticaObjetivo(?TipoFisico $composicion_atletica_objetivo): self
    {
        $this->composicion_atletica_objetivo = $composicion_atletica_objetivo;

        return $this;
    }

    public function getMetabolismoBasal()
    {
        return $this->metabolismo_basal;
    }

    public function setMetabolismoBasal($metabolismo_basal): self
    {
        $this->metabolismo_basal = $metabolismo_basal;

        return $this;
    }
}
