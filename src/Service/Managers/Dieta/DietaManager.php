<?php


namespace App\Service\Managers\Dieta;


use App\Entity\Dieta;
use App\Service\Managers\AbstractManager;
use Doctrine\Common\Persistence\ObjectRepository;

class DietaManager extends AbstractManager
{

    /**
     * @return ObjectRepository
     */
    protected function getRepository()
    {
        return $this->doctrine->getRepository(Dieta::class);
    }
}