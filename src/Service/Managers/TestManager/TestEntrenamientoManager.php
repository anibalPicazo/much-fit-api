<?php


namespace App\Service\Managers\TestManager;


use App\DTO\TestUsuario\TestUsuarioEntrenamientoCreateDTO;
use App\Entity\PremisasRutina;
use App\Entity\TestUsuario;
use App\Service\Managers\AbstractManager;
use App\Service\Uploads\AbstractUploadStorage;
use Doctrine\Common\Persistence\ObjectRepository;

class TestEntrenamientoManager extends AbstractManager{

    public function create(TestUsuarioEntrenamientoCreateDTO $DTO)
    {
        $test = new TestUsuario();
        $test->setUuid($DTO->getUuid());
        $test->setUser($this->getCurrent());
        $test->setFormaFisica($DTO->getFormaFisica());
        $test->setExperienciaDeporte($DTO->getExperienciaDeporte());
        $test->setFrecuenciaEntrenamiento($DTO->getFrecuencia());
        $DTO->getObjetivo() ? $test->setObjetivo($DTO->getObjetivo()) : null;

        $rule_exp = $this->doctrine->getRepository(PremisasRutina::class)->findOneBy(['hint'=> $this->calcExperiencia($DTO)]);
        $rule_frec = $this->doctrine->getRepository(PremisasRutina::class)->findOneBy(['hint'=>$this->calcFrecuencia($DTO)]);
        $rule_ob = $this->doctrine->getRepository(PremisasRutina::class)->findOneBy(['hint' => $DTO->getObjetivo()]);
        $rule_estadofiscio = $this->doctrine->getRepository(PremisasRutina::class)->findOneBy(['hint'=>$DTO->getFormaFisica()]);


        $this->save($test);
        return $test;
    }

    /**
     * @param TestUsuarioEntrenamientoCreateDTO $DTO
     * @return string
     */
    public function calcFrecuencia(TestUsuarioEntrenamientoCreateDTO $DTO)
    {
        switch ($DTO->getFrecuencia()) {
            case 'Menos de dos días':
                $frec = 'Bajo';
                break;
            case 'Entre 2 y 3 días':
                $frec = 'Medio';
                break;
            case 'Más de 3 días':
                $frec = 'Alto';
                break;

        }
        return $frec;
    }

    /**
     * @param TestUsuarioEntrenamientoCreateDTO $DTO
     * @return string
     */
    public function calcExperiencia(TestUsuarioEntrenamientoCreateDTO $DTO)
    {
        switch ($DTO->getExperienciaDeporte()) {
            case 'Más de un año':
                $exp = 'Muy alta';
                break;
            case 'De ocho meses a un año':
                $exp = 'Alta';
                break;
            case 'De dos a ocho meses':
                $exp = 'Media';
                break;
            case 'De cero a dos meses':
                $exp = 'Baja';
                break;
        }
        return $exp;
    }

    /**
     * @return ObjectRepository
     */
    protected function getRepository()
    {
        return $this->doctrine->getRepository(TestUsuario::class);
    }


}
