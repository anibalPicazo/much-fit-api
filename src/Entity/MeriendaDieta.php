<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MeriendaDietaRepository")
 */
class MeriendaDieta
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
     * @ORM\OneToMany(targetEntity="App\Entity\DietasGenericas", mappedBy="meriendaDieta")
     */
    private $dietasGenericas;

    public function __construct()
    {
        $this->dietasGenericas = new ArrayCollection();
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
     * @return Collection|DietasGenericas[]
     */
    public function getDietasGenericas(): Collection
    {
        return $this->dietasGenericas;
    }

    public function addDietasGenerica(DietasGenericas $dietasGenerica): self
    {
        if (!$this->dietasGenericas->contains($dietasGenerica)) {
            $this->dietasGenericas[] = $dietasGenerica;
            $dietasGenerica->setMeriendaDieta($this);
        }

        return $this;
    }

    public function removeDietasGenerica(DietasGenericas $dietasGenerica): self
    {
        if ($this->dietasGenericas->contains($dietasGenerica)) {
            $this->dietasGenericas->removeElement($dietasGenerica);
            // set the owning side to null (unless already changed)
            if ($dietasGenerica->getMeriendaDieta() === $this) {
                $dietasGenerica->setMeriendaDieta(null);
            }
        }

        return $this;
    }
}
