<?php
namespace App\DTO\Cliente;

use App\DTO\DTOInterface;
use JMS\Serializer\Annotation as JMSSerializer;
use Symfony\Component\Validator\Constraints as Assert;

class ClienteCreateDTO implements DTOInterface
{
    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $nombre;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $uuid;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $username;

    /**
     * @Assert\NotNull()
     * @Assert\Email()
     * @JMSSerializer\Type("string")
     */
    protected $email;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $password;

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }


    /**
     * ClienteCreateDTO constructor.
     * @param $uuid
     * @param $nombre
     * @param $username
     * @param $password
     * @param $email
     */
    public function __construct($uuid, $nombre, $username, $password, $email)
    {
        $this->nombre = $nombre;
        $this->uuid = $uuid;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
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
    public function getUuid()
    {
        return $this->uuid;
    }


}