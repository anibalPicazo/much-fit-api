<?php


namespace App\EventSubscriber\Event;



use App\DTO\DTOInterface;
use Symfony\Contracts\EventDispatcher\Event;

class RutinaEvent extends Event
{
    const RUTINA_CREATED = "rutina.created";
    const RUTINA_ASIGNATED = "rutina.asignated";
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
