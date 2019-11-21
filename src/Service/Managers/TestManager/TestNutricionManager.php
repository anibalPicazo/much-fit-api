<?php


namespace App\Service\Managers\TestManager;


use App\DTO\TestUsuario\TestNutricionalCreateDTO;
use App\Entity\Dieta;
use App\Entity\PremisasDieta;
use App\Entity\TestUsuario;
use App\Entity\TestUsuarioDieta;
use App\Entity\User;
use App\Service\Managers\AbstractManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class TestNutricionManager extends AbstractManager
{


    public function create(TestNutricionalCreateDTO $DTO)
    {

        /** @var User $user */
        $user = $this->getCurrent();
        $test = new TestUsuarioDieta();
        $test->setUuid($DTO->getUuid());
        $test->setUser($user);
        $test->setAltura($DTO->getAltura());
        $test->setPeso($DTO->getPeso());
        $test->setEdad($DTO->getEdad());
        $test->setActividadFisica($DTO->getEdad());
        $DTO->getEstadoFisico() ? $test->setEstadoFisico($DTO->getEstadoFisico()) : null;
        $DTO->getEstadoFisicoObjetivo() ? $test->setEstadoFisicoObjetivo($DTO->getEstadoFisicoObjetivo()) : null;
        $DTO->getImc() ? $test->setImc($DTO->getImc()) : $test->setImc($DTO->getPeso() / ($DTO->getAltura()/100));
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

        $dieta_clp = $this->ruler($exp,$actual,$objetivo);
        /** @var Dieta $dieta */
        $dieta = $this->doctrine->getRepository(Dieta::class)->findOneBy(['descripcion'=> $dieta_clp]);
        $user->setDieta($dieta);
        $this->save($user);
        $this->save($test);

        return $dieta;
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
                $objetivo = 'definicion';
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

        return sizeof($arrFacts) >0 ? $arrFacts[0][0] : 'hipocalorica' ;


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
                $exp = 'intermedia';
                break;
            case  'De dos a cuatro años':
                $exp = 'novato';
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
