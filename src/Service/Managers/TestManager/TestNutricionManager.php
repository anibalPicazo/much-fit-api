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
        $test->setPeso($DTO->getPeso());
        $test->setEdad($DTO->getEdad());
        $test->setActividadFisica($DTO->getEdad());
        $test->setEstadoFisico($DTO->getEstadoFisico());
        $test->setEstadoFisicoObjetivo($DTO->getEstadoFisicoObjetivo());
        $DTO->getImc() ? $test->setImc($DTO->getImc()) : null;
        $DTO->getGrasa() ? $test->setGrasa($DTO->getGrasa()) : null;
        $test->setGenero($DTO->getGenero());
        $test->setActividadFisica($DTO->getActividadFisica());
        if ($DTO->getGenero() === 'Hombre') {
            $mb = 66.473 + (13.751 * $DTO->getPeso()) + (5.0033 * $DTO->getAltura()) - (6.7550 * $DTO->getEdad());
        } else {
            $mb = 655.1 + (9.463 * $DTO->getPeso()) + (1.8 * $DTO->getAltura()) - (4.6756 *$DTO->getEdad());
        }


        $gasto =  $this->calculateGastoCalorico($DTO, $mb);
        $objetivo = $this->calcObjetivo($DTO);
        $actual = $this->calcEstadoActual($DTO);
        $exp = $this->calcExperiencia($DTO);

        $this->ruler('',$actual,$objetivo);


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
                $actual = 'normopeso';
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
    public function ruler($experiencia='',$estadofisico='',$objetivo='')
    {
        dump($experiencia, $estadofisico,$objetivo);
        die();
        //Initialise CLIPS environment and variables.
        ini_set('max_execution_time', 0);
        $arrCtx = array(); // This is the context, in which CLIPS runs.
        clips_init($arrCtx);
        ob_start(); // Turn on output buffering to capture CLIPS command outputs.

        clips_exec('(clear)', false);
        clips_exec('(reset)', false);
        //REGLA 1:
        clips_exec('(defrule r1 (objetivo definicion)
                                (estado-fisico sobrepeso) => 
                                (assert (dieta hipocalorica)) )', false);
        //REGLA 2:
        clips_exec('(defrule r2 (objetivo volumen)
                                (experiencia novato) => 
                                (assert (dieta calorica-hidratos)) )', false);
        //REGLA 3:
        clips_exec('(defrule r3 (objetivo volumen)
                                (experiencia intermedia) => 
                                (assert (dieta mantenimiento)) )', false);
        //REGLA 4:
        clips_exec('(defrule r4 (objetivo volumen)
                                (experiencia alta) => 
                                (assert (dieta mantenimiento)) )', false);


        //INSERCION DE LOS HECHOS
        $experiencia !== '' ? clips_exec('(assert (experiencia '.$experiencia.' ))', false) : null;
        $estadofisico !== '' ? clips_exec('(assert (estado-fisico '.$estadofisico.'))', false) : null;
        $objetivo !== '' ? clips_exec('(assert (objetivo '.$objetivo.'))', false) : null;

        //EJECUTAMOS LAS REGLAS
        clips_exec('(run)', false);
        ob_end_clean(); //Clear output buffer and cease buffering.
        $arrFacts = array();
        clips_query_facts($arrFacts, 'dieta');


        //CONSECUENTE
        return   $arrFacts[0][0] ;


    }

    /**
     * @param TestNutricionalCreateDTO $DTO
     * @return string
     */
    public function calcExperiencia(TestNutricionalCreateDTO $DTO)
    {
        switch ($DTO->getExperiencia()) {
            case 'Más de un año':
                $exp = 'alta';
                break;
            case 'Menos de dos años':
                $exp = 'baja';
                break;
            case  'De dos a cuatro años':
                $exp = 'media';
                break;
            default:
                $exp = '';
        }
        return $exp;
    }

    /**
     * @return ObjectRepository
     */
    protected function getRepository()
    {
        return $this->doctrine->getRepository(TestUsuarioDieta::class);
    }

}
