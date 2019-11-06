<?php


namespace App\Service\Managers\TestManager;


use App\DTO\TestUsuario\TestNutricionalCreateDTO;
use App\Entity\PremisasDieta;
use App\Entity\TestUsuario;
use App\Entity\TestUsuarioDieta;
use App\Service\Managers\AbstractManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class TestNutricionManager extends AbstractManager
{


    public function create(TestNutricionalCreateDTO $DTO)
    {
        $test = new TestUsuarioDieta();
        $test->setUuid($DTO->getUuid());
        $test->setUser($this->getCurrent());
        $test->setAltura($DTO->getAltura());
        $test->setActividadFisica($DTO->getEdad());
        $test->setEstadoFisico($DTO->getEstadoFisico());
        $test->setEstadoFisicoObjetivo($DTO->getEstadoFisicoObjetivo());
        $DTO->getImc() ? $test->setImc($DTO->getImc()) : null;
        $test->setGenero($DTO->getGenero());
        $test->setActividadFisica($DTO->getActividadFisica());
        if ($DTO->getGenero() === 'Hombre') {
            $mb = 66.473 + (13.751 * Integer.valueOf($DTO->getPeso())) + (5.0033 * Integer.valueOf($DTO->getAltura())) - (6.7550 * Integer.valueOf($DTO->getEdad()));
        } else {
            $mb = 655.1 + (9.463 * Integer.valueOf($DTO->getPeso())) + (1.8 * Integer.valueOf($DTO->getAltura())) - (4.6756 * Integer.valueOf($DTO->getEdad()));
        }

        $gasto =  $this->calculateGastoCalorico($DTO, $mb);
        $objetivo = $this->calcObjetivo($DTO);
        $actual = $this->calcEstadoActual($DTO);
        /** @var PremisasDieta $premisa_objetivo */
        $premisa_objetivo = $this->doctrine->getRepository(PremisasDieta::class)->findOneBy(['hint'=> $objetivo]);
        /** @var PremisasDieta $premisa_actual */
        $premisa_actual = $this->doctrine->getRepository(PremisasDieta::class)->findOneBy(['hint'=> $actual]);


        dump('objetivo', $premisa_objetivo->getRuleCode());
        dump('actual',$premisa_actual->getRuleCode());
        die();



        //todo: Entrada al test  $estado_fisico ,$objetivo

        //todo: salida SBR  $this->doctrine->getRepository(ConsecuenteDieta::class)->findOneBy(['rule_code' => $resultado_salida])



        $this->save($test);
        return $test;
    }

    /**
     * @param TestNutricionalCreateDTO $DTO
     * @param $mb
     * @return float
     */
    public function calculateGastoCalorico(TestNutricionalCreateDTO $DTO, $mb): float
    {
        switch ($DTO->getActividadFisica()) {
            case 'Sedentario':
                $gasto_calorico = $mb * 1.2;
                break;
            case 'Levemente activo':
                $gasto_calorico = $mb * 1.375;
                break;
            case 'Moderadamente activo':
                $gasto_calorico = $mb * 1.55;
                break;
            case 'Muy activo':
                $gasto_calorico = $mb * 1.725;
                break;
            case 'Hiperactivo':
                $gasto_calorico = $mb * 1.9;
                break;
        }
        return $gasto_calorico;
    }

    /**
     * @param TestNutricionalCreateDTO $DTO
     * @return string
     */
    public function calcObjetivo(TestNutricionalCreateDTO $DTO): string
    {
        switch ($DTO->getEstadoFisicoObjetivo()) {
            case 'Delgado':
                $objetivo = 'perderGrasa';
                break;
            case 'Definido':
                $objetivo = 'defincion';
                break;
            case 'Tasado':
                $objetivo = 'volumen';
        }
        return $objetivo;
    }

    /**
     * @param TestNutricionalCreateDTO $DTO
     * @return string
     */
    public function calcEstadoActual(TestNutricionalCreateDTO $DTO): string
    {
        switch ($DTO->getEstadoFisico()) {
            case 'Delgado':
                $actual = 'normoPeso';
                break;
            case 'Definido':
                $actual = 'definido';
                break;
            case 'Tasado' :
                $actual = 'sobrepeso';
                break;
        }
        return $actual;
    }

    /**
     * @return ObjectRepository
     */
    protected function getRepository()
    {
        return $this->doctrine->getRepository(TestUsuarioDieta::class);
    }

}
