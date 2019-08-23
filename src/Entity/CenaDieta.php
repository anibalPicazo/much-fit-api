<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CenaDietaRepository")
 */
class CenaDieta
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Alimentos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $alimento;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $cantidad;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $unidades;

    /**
     * @ORM\OneToMany(targetEntity="Dieta", mappedBy="cenaDieta")
     */
    private $dietas;

    public function __construct()
    {
        $this->dietas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAlimento(): ?Alimentos
    {
        return $this->alimento;
    }

    public function setAlimento(?Alimentos $alimento): self
    {
        $this->alimento = $alimento;

        return $this;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function setCantidad($cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getUnidades(): ?string
    {
        return $this->unidades;
    }

    public function setUnidades(string $unidades): self
    {
        $this->unidades = $unidades;

        return $this;
    }

    /**
     * @return Collection|Dieta[]
     */
    public function getdietas(): Collection
    {
        return $this->dietas;
    }

    public function addDieta(Dieta $dieta): self
    {
        if (!$this->dietas->contains($dieta)) {
            $this->dietas[] = $dieta;
            $dieta->setCenaDieta($this);
        }

        return $this;
    }

    public function remove(Dieta $dieta): self
    {
        if ($this->dietas->contains($dieta)) {
            $this->dietas->removeElement($dieta);
            // set the owning side to null (unless already changed)
            if ($dieta->getCenaDieta() === $this) {
                $dieta->setCenaDieta(null);
            }
        }

        return $this;
    }
}
