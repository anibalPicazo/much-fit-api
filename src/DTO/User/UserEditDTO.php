<?php


namespace App\DTO\User;

use App\DTO\DTOInterface;
use JMS\Serializer\Annotation as JMSSerializer;
use Symfony\Component\Validator\Constraints as Assert;

class UserEditDTO implements DTOInterface
{

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    private $username;

    /**
     * @Assert\NotNull()
     * @Assert\Email()
     * @JMSSerializer\Type("string")
     */
    private $email;


    /**
     * UserCreateDTO constructor.
     * @param $username
     * @param $email
     */
    public function __construct($username, $email)
    {
        $this->username = $username;
        $this->email = $email;
    }

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


}
