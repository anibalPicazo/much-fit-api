<?php


namespace App\DTO\User;


use App\DTO\DTOInterface;
use JMS\Serializer\Annotation as JMSSerializer;
use Symfony\Component\Validator\Constraints as Assert;

class AsignarEmpresaDTO implements DTOInterface
{
    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("Entity<App\Entity\User>")
     */
    protected $user;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("Entity<App\Entity\Empresa>")
     */
    protected $empresa;

    /**
     * AsignarEmpresaDTO constructor.
     * @param $user
     * @param $empresa
     */
    public function __construct($user, $empresa)
    {
        $this->user = $user;
        $this->empresa = $empresa;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

}
