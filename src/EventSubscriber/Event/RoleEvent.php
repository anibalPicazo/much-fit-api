<?php


namespace App\EventSubscriber\Event;


use App\DTO\DTOInterface;
use Symfony\Component\EventDispatcher\Event;

final class RoleEvent extends Event
{

    const ROLE_CREATED = "role.created";

    /**
     * @var DTOInterface
     */
    private $DTO;

    /**
     * ArticleEvent constructor.
     * @param DTOInterface $DTO
     */
    public function __construct($DTO)
    {
        $this->DTO = $DTO;
    }

    /**
     * @return DTOInterface
     */
    public function getDTO(): DTOInterface
    {
        return $this->DTO;
    }


}
