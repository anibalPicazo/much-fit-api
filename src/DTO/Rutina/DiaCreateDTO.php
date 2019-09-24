<?php


namespace App\DTO\Rutina;

use App\DTO\DTOInterface;
use JMS\Serializer\Annotation as JMSSerializer;
use Symfony\Component\Validator\Constraints as Assert;

class DiaCreateDTO implements  DTOInterface
{
    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $uuid;
    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $nombre;
    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("Entity<App/Entity/Rutina>")
     */
    protected $rutina;


    /**
     * DiaCreateDTO constructor.
     * @param $uuid
     * @param $nombre
     * @param $rutina
     */
    public function __construct($uuid, $nombre,$rutina)
    {
        $this->uuid = $uuid;
        $this->nombre = $nombre;
        $this->rutina = $rutina;
    }

    /**
     * @return mixed
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @return mixed
     */
    public function getRutina()
    {
        return $this->rutina;
    }

}
