<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostCenaDietaRepository")
 */
class PostCenaDieta
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
}
