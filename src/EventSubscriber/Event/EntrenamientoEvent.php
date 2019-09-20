<?php


namespace App\EventSubscriber\Event;


use App\DTO\DTOInterface;
use Symfony\Contracts\EventDispatcher\Event;

class EntrenamientoEvent extends Event
{
    const ENTRENAMIENTO_CREATED = "entrenamiento.created";
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
