<?php

namespace App\Entity;

use App\Entity\Traits\TimestampableTrait;
use App\Entity\Traits\UuidTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CuardernoEntrenamientoRepository")
 */
class CuadernoEntrenamiento
{
    use UuidTrait;
    use TimestampableTrait;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="cuardernoEntrenamiento", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\HojaCuaderno", mappedBy="cuardernoEntrenamiento", orphanRemoval=true)
     */
    private $hojas;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\HojaCuadernoDieta", mappedBy="cuaderno", orphanRemoval=true)
     */
    private $hojaCuadernoDietas;

    public function __construct()
    {
        $this->hojas = new ArrayCollection();
        $this->hojaCuadernoDietas = new ArrayCollection();
    }




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuario(): ?User
    {
        return $this->usuario;
    }

    public function setUsuario(User $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * @return Collection|HojaCuaderno[]
     */
    public function getHojas(): Collection
    {
        return $this->hojas;
    }

    public function addHoja(HojaCuaderno $hoja): self
    {
        if (!$this->hojas->contains($hoja)) {
            $this->hojas[] = $hoja;
            $hoja->setCuardernoEntrenamiento($this);
        }

        return $this;
    }

    public function removeHoja(HojaCuaderno $hoja): self
    {
        if ($this->hojas->contains($hoja)) {
            $this->hojas->removeElement($hoja);
            // set the owning side to null (unless already changed)
            if ($hoja->getCuardernoEntrenamiento() === $this) {
                $hoja->setCuardernoEntrenamiento(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|HojaCuadernoDieta[]
     */
    public function getHojaCuadernoDietas(): Collection
    {
        return $this->hojaCuadernoDietas;
    }

    public function addHojaCuadernoDieta(HojaCuadernoDieta $hojaCuadernoDieta): self
    {
        if (!$this->hojaCuadernoDietas->contains($hojaCuadernoDieta)) {
            $this->hojaCuadernoDietas[] = $hojaCuadernoDieta;
            $hojaCuadernoDieta->setCuaderno($this);
        }

        return $this;
    }

    public function removeHojaCuadernoDieta(HojaCuadernoDieta $hojaCuadernoDieta): self
    {
        if ($this->hojaCuadernoDietas->contains($hojaCuadernoDieta)) {
            $this->hojaCuadernoDietas->removeElement($hojaCuadernoDieta);
            // set the owning side to null (unless already changed)
            if ($hojaCuadernoDieta->getCuaderno() === $this) {
                $hojaCuadernoDieta->setCuaderno(null);
            }
        }

        return $this;
    }


}
