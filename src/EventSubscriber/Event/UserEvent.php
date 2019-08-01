<?php

namespace App\EventSubscriber\Event;

use App\DTO\DTOInterface;
use Symfony\Contracts\EventDispatcher\Event;

final class UserEvent extends Event
{

    const USER_CREATED = "user.created";
    const USER_COMPANY_DESIGNATED = "user.company.designated";

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
