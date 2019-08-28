<?php

namespace App\Entity;

use App\Entity\Traits\UuidTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TestUsuarioDietaRepository")
 */
class TestUsuarioDieta
{
    use UuidTrait;


    /**
     * @ORM\Column(type="decimal", precision=6, scale=3)
     */
    private $peso;

    /**
     * @ORM\Column(type="integer")
     */
    private $edad;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $genero;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=3)
     */
    private $altura;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TipoFisico", inversedBy="estad_actual_test_dieta")
     * @ORM\JoinColumn(nullable=false)
     */
    private $estado_actual;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TipoFisico", inversedBy="estado_objetivo_test_dieta")
     * @ORM\JoinColumn(nullable=false)
     */
    private $estado_objetivo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ActividadFisica", inversedBy="test_dietas_usuario")
     * @ORM\JoinColumn(nullable=false)
     */
    private $actividad_fisica;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="testUsuarioDietas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

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


    public function getEstadoActual(): ?TipoFisico
    {
        return $this->estado_actual;
    }

    public function setEstadoActual(?TipoFisico $estado_actual): self
    {
        $this->estado_actual = $estado_actual;

        return $this;
    }

    public function getEstadoObjetivo(): ?TipoFisico
    {
        return $this->estado_objetivo;
    }

    public function setEstadoObjetivo(?TipoFisico $estado_objetivo): self
    {
        $this->estado_objetivo = $estado_objetivo;

        return $this;
    }

    public function getActividadFisica(): ?ActividadFisica
    {
        return $this->actividad_fisica;
    }

    public function setActividadFisica(?ActividadFisica $actividad_fisica): self
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
}
