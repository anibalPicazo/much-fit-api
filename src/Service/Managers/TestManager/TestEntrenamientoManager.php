<?php


namespace App\Service\Managers\TestManager;


use App\DTO\TestUsuario\TestUsuarioEntrenamientoCreateDTO;
use App\Entity\TestUsuario;
use App\Service\Managers\AbstractManager;
use App\Service\Uploads\AbstractUploadStorage;
use Doctrine\Common\Persistence\ObjectRepository;

class TestEntrenamientoManager extends AbstractManager{

    public function create(TestUsuarioEntrenamientoCreateDTO $DTO)
    {
        $test = new TestUsuario();
        $test->setUuid($DTO->getUuid());
        $test->setUser($DTO->getUser());
        $test->setFormaFisica($DTO->getFormaFisica());
        $test->setExperienciaDeporte($DTO->getExperienciaDeporte());
        $test->setFrecuenciaEntrenamiento($DTO->getFrecuencia());

        $this->save($test);
        return $test;

    }

    /**
     * @return ObjectRepository
     */
    protected function getRepository()
    {
        return $this->doctrine->getRepository(TestUsuario::class);
    }


}
