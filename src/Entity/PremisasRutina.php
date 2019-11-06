<?php

namespace App\Entity;

use App\Entity\Traits\UuidTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PremisasRutinaRepository")
 */
class PremisasRutina
{
    use UuidTrait;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hint;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rule_code;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHint(): ?string
    {
        return $this->hint;
    }

    public function setHint(string $hint): self
    {
        $this->hint = $hint;

        return $this;
    }

    public function getRuleCode(): ?string
    {
        return $this->rule_code;
    }

    public function setRuleCode(string $ruleCode): self
    {
        $this->rule_code = $ruleCode;

        return $this;
    }
}
