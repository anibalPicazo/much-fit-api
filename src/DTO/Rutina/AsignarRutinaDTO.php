<?php


namespace App\DTO\Rutina;


use App\DTO\DTOInterface;
use JMS\Serializer\Annotation as JMSSerializer;
use Symfony\Component\Validator\Constraints as Assert;

class AsignarRutinaDTO implements DTOInterface
{
    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("Entity<App\Entity\Rutina>")
     */
    protected $rutina;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("Entity<App\Entity\User>")
     */
    protected $user;

    public function __construct($rutina, $user)
    {

        $this->rutina = $rutina;
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getRutina()
    {
        return $this->rutina;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

}
