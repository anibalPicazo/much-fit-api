<?php


namespace App\EventSubscriber\Event;


use Symfony\Contracts\EventDispatcher\Event;

class TestEntrenamientoEvent extends Event
{
    const TEST_ENTRENAMIENTO_CREATE = 'test.entrenamiento.created';

    private $DTO;

    /**
     * TestEntrenamientoEvent constructor.
     * @param $DTO
     */
    public function __construct($DTO)
    {
        $this->DTO = $DTO;
    }

}
