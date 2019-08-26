<?php

namespace App\Entity;

use App\Entity\Traits\UuidTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MarcaAlimentoRepository")
 */
class MarcaAlimento
{
    use UuidTrait;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descripccion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Alimentos", mappedBy="marca_alimento")
     */
    private $alimentos;

    public function __construct()
    {
        $this->alimentos = new ArrayCollection();
    }

    public function getDescripccion(): ?string
    {
        return $this->descripccion;
    }

    public function setDescripccion(?string $descripccion): self
    {
        $this->descripccion = $descripccion;

        return $this;
    }

    /**
     * @return Collection|Alimentos[]
     */
    public function getAlimentos(): Collection
    {
        return $this->alimentos;
    }

    public function addAlimento(Alimentos $alimento): self
    {
        if (!$this->alimentos->contains($alimento)) {
            $this->alimentos[] = $alimento;
            $alimento->setMarcaAlimento($this);
        }

        return $this;
    }

    public function removeAlimento(Alimentos $alimento): self
    {
        if ($this->alimentos->contains($alimento)) {
            $this->alimentos->removeElement($alimento);
            // set the owning side to null (unless already changed)
            if ($alimento->getMarcaAlimento() === $this) {
                $alimento->setMarcaAlimento(null);
            }
        }

        return $this;
    }
}
