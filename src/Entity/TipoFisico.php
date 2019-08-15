<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TipoFisicoRepository")
 */
class TipoFisico
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
    private $descripcion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TestUsuario", mappedBy="composicon_atletica", orphanRemoval=true)
     */
    private $usuarios_composion_atletica_comienzo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TestUsuario", mappedBy="composicion_atletica_objetivo", orphanRemoval=true)
     */
    private $usuario_composicon_atletica_objetivo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TestUsuarioDieta", mappedBy="estado_actual", orphanRemoval=true)
     */
    private $estad_actual_test_dieta;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TestUsuarioDieta", mappedBy="estado_objetivo", orphanRemoval=true)
     */
    private $estado_objetivo_test_dieta;

    public function __construct()
    {
        $this->usuarios_composion_atletica_comienzo = new ArrayCollection();
        $this->usuario_composicon_atletica_objetivo = new ArrayCollection();
        $this->estad_actual_test_dieta = new ArrayCollection();
        $this->estado_objetivo_test_dieta = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|TestUsuario[]
     */
    public function getUsuariosComposionAtleticaComienzo(): Collection
    {
        return $this->usuarios_composion_atletica_comienzo;
    }

    public function addUsuariosComposionAtleticaComienzo(TestUsuario $usuariosComposionAtleticaComienzo): self
    {
        if (!$this->usuarios_composion_atletica_comienzo->contains($usuariosComposionAtleticaComienzo)) {
            $this->usuarios_composion_atletica_comienzo[] = $usuariosComposionAtleticaComienzo;
            $usuariosComposionAtleticaComienzo->setComposiconAtletica($this);
        }

        return $this;
    }

    public function removeUsuariosComposionAtleticaComienzo(TestUsuario $usuariosComposionAtleticaComienzo): self
    {
        if ($this->usuarios_composion_atletica_comienzo->contains($usuariosComposionAtleticaComienzo)) {
            $this->usuarios_composion_atletica_comienzo->removeElement($usuariosComposionAtleticaComienzo);
            // set the owning side to null (unless already changed)
            if ($usuariosComposionAtleticaComienzo->getComposiconAtletica() === $this) {
                $usuariosComposionAtleticaComienzo->setComposiconAtletica(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TestUsuario[]
     */
    public function getUsuarioComposiconAtleticaObjetivo(): Collection
    {
        return $this->usuario_composicon_atletica_objetivo;
    }

    public function addUsuarioComposiconAtleticaObjetivo(TestUsuario $usuarioComposiconAtleticaObjetivo): self
    {
        if (!$this->usuario_composicon_atletica_objetivo->contains($usuarioComposiconAtleticaObjetivo)) {
            $this->usuario_composicon_atletica_objetivo[] = $usuarioComposiconAtleticaObjetivo;
            $usuarioComposiconAtleticaObjetivo->setComposicionAtleticaObjetivo($this);
        }

        return $this;
    }

    public function removeUsuarioComposiconAtleticaObjetivo(TestUsuario $usuarioComposiconAtleticaObjetivo): self
    {
        if ($this->usuario_composicon_atletica_objetivo->contains($usuarioComposiconAtleticaObjetivo)) {
            $this->usuario_composicon_atletica_objetivo->removeElement($usuarioComposiconAtleticaObjetivo);
            // set the owning side to null (unless already changed)
            if ($usuarioComposiconAtleticaObjetivo->getComposicionAtleticaObjetivo() === $this) {
                $usuarioComposiconAtleticaObjetivo->setComposicionAtleticaObjetivo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TestUsuarioDieta[]
     */
    public function getEstadActualTestDieta(): Collection
    {
        return $this->estad_actual_test_dieta;
    }

    public function addEstadActualTestDietum(TestUsuarioDieta $estadActualTestDietum): self
    {
        if (!$this->estad_actual_test_dieta->contains($estadActualTestDietum)) {
            $this->estad_actual_test_dieta[] = $estadActualTestDietum;
            $estadActualTestDietum->setEstadoActual($this);
        }

        return $this;
    }

    public function removeEstadActualTestDietum(TestUsuarioDieta $estadActualTestDietum): self
    {
        if ($this->estad_actual_test_dieta->contains($estadActualTestDietum)) {
            $this->estad_actual_test_dieta->removeElement($estadActualTestDietum);
            // set the owning side to null (unless already changed)
            if ($estadActualTestDietum->getEstadoActual() === $this) {
                $estadActualTestDietum->setEstadoActual(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TestUsuarioDieta[]
     */
    public function getEstadoObjetivoTestDieta(): Collection
    {
        return $this->estado_objetivo_test_dieta;
    }

    public function addEstadoObjetivoTestDietum(TestUsuarioDieta $estadoObjetivoTestDietum): self
    {
        if (!$this->estado_objetivo_test_dieta->contains($estadoObjetivoTestDietum)) {
            $this->estado_objetivo_test_dieta[] = $estadoObjetivoTestDietum;
            $estadoObjetivoTestDietum->setEstadoObjetivo($this);
        }

        return $this;
    }

    public function removeEstadoObjetivoTestDietum(TestUsuarioDieta $estadoObjetivoTestDietum): self
    {
        if ($this->estado_objetivo_test_dieta->contains($estadoObjetivoTestDietum)) {
            $this->estado_objetivo_test_dieta->removeElement($estadoObjetivoTestDietum);
            // set the owning side to null (unless already changed)
            if ($estadoObjetivoTestDietum->getEstadoObjetivo() === $this) {
                $estadoObjetivoTestDietum->setEstadoObjetivo(null);
            }
        }

        return $this;
    }
}
