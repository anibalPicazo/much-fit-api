<?php

namespace App\Entity;

use App\Entity\Traits\UuidTrait;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TestUsuarioDietaRepository")
 * @Serializer\ExclusionPolicy("all")
 */
class TestUsuarioDieta
{
    use UuidTrait;


    /**
     * @ORM\Column(type="decimal", precision=6, scale=3)
     * @Serializer\Groups({"list"})
     * @Serializer\Expose()*/
    private $peso;

    /**
     * @ORM\Column(type="integer")
     * @Serializer\Groups({"list"})
     * @Serializer\Expose()
     */
    private $edad;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"list"})
     * @Serializer\Expose()
     */
    private $genero;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     * @Serializer\Groups({"list"})
     * @Serializer\Expose()
     */
    private $altura;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"list"})
     * @Serializer\Expose()
     */
    private $actividad_fisica;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="testUsuarioDietas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"list"})
     * @Serializer\Expose()
     */
    private $estado_fisico;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"list"})
     * @Serializer\Expose()
     */
    private $estado_fisico_objetivo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Serializer\Groups({"list"})
     * @Serializer\Expose()
     */
    private $imc;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2, nullable=true)
     * @Serializer\Groups({"list"})
     * @Serializer\Expose()
     */
    private $grasa;

    public function getPeso()
    {
        return $this->peso;
    }

    public function setPeso($peso): self
    {
        $this->peso = $peso;

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

    public function getGenero(): ?string
    {
        return $this->genero;
    }

    public function setGenero(string $genero): self
    {
        $this->genero = $genero;

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

    public function getActividadFisica()
    {
        return $this->actividad_fisica;
    }

    public function setActividadFisica($actividad_fisica): self
    {
        $this->actividad_fisica = $actividad_fisica;

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

    public function getEstadoFisico(): ?string
    {
        return $this->estado_fisico;
    }

    public function setEstadoFisico(string $estado_fisico): self
    {
        $this->estado_fisico = $estado_fisico;

        return $this;
    }

    public function getEstadoFisicoObjetivo(): ?string
    {
        return $this->estado_fisico_objetivo;
    }

    public function setEstadoFisicoObjetivo(string $estado_fisico_objetivo): self
    {
        $this->estado_fisico_objetivo = $estado_fisico_objetivo;

        return $this;
    }

    public function getImc(): ?string
    {
        return $this->imc;
    }

    public function setImc(?string $imc): self
    {
        $this->imc = $imc;

        return $this;
    }

    public function getGrasa()
    {
        return $this->grasa;
    }

    public function setGrasa($grasa): self
    {
        $this->grasa = $grasa;

        return $this;
    }
}
