<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EntrenamientoLineasRepository")
 */
class EntrenamientoLineas
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ejercicios", inversedBy="serie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ejercicio;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $serie;

    /**
     * @ORM\Column(type="integer")
     */
    private $repeticiones;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=3)
     */
    private $kilos;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Entrenamiento", inversedBy="lineas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entrenamiento;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEjercicio(): ?Ejercicios
    {
        return $this->ejercicio;
    }

    public function setEjercicio(?Ejercicios $ejercicio): self
    {
        $this->ejercicio = $ejercicio;

        return $this;
    }

    public function getSerie(): ?string
    {
        return $this->serie;
    }

    public function setSerie(string $serie): self
    {
        $this->serie = $serie;

        return $this;
    }

    public function getRepeticiones(): ?int
    {
        return $this->repeticiones;
    }

    public function setRepeticiones(int $repeticiones): self
    {
        $this->repeticiones = $repeticiones;

        return $this;
    }

    public function getKilos()
    {
        return $this->kilos;
    }

    public function setKilos($kilos): self
    {
        $this->kilos = $kilos;

        return $this;
    }

    public function getEntrenamiento(): ?Entrenamiento
    {
        return $this->entrenamiento;
    }

    public function setEntrenamiento(?Entrenamiento $entrenamiento): self
    {
        $this->entrenamiento = $entrenamiento;

        return $this;
    }
}
