<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActividadFisicaRepository")
 */
class ActividadFisica
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nivel;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=3)
     */
    private $factor_correcion_metabolismo_basal;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TestUsuarioDieta", mappedBy="actividad_fisica", orphanRemoval=true)
     */
    private $test_dietas_usuario;

    public function __construct()
    {
        $this->test_dietas_usuario = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNivel(): ?string
    {
        return $this->nivel;
    }

    public function setNivel(string $nivel): self
    {
        $this->nivel = $nivel;

        return $this;
    }

    public function getFactorCorrecionMetabolismoBasal()
    {
        return $this->factor_correcion_metabolismo_basal;
    }

    public function setFactorCorrecionMetabolismoBasal($factor_correcion_metabolismo_basal): self
    {
        $this->factor_correcion_metabolismo_basal = $factor_correcion_metabolismo_basal;

        return $this;
    }

    /**
     * @return Collection|TestUsuarioDieta[]
     */
    public function getTestDietasUsuario(): Collection
    {
        return $this->test_dietas_usuario;
    }

    public function addTestDietasUsuario(TestUsuarioDieta $testDietasUsuario): self
    {
        if (!$this->test_dietas_usuario->contains($testDietasUsuario)) {
            $this->test_dietas_usuario[] = $testDietasUsuario;
            $testDietasUsuario->setActividadFisica($this);
        }

        return $this;
    }

    public function removeTestDietasUsuario(TestUsuarioDieta $testDietasUsuario): self
    {
        if ($this->test_dietas_usuario->contains($testDietasUsuario)) {
            $this->test_dietas_usuario->removeElement($testDietasUsuario);
            // set the owning side to null (unless already changed)
            if ($testDietasUsuario->getActividadFisica() === $this) {
                $testDietasUsuario->setActividadFisica(null);
            }
        }

        return $this;
    }
}
