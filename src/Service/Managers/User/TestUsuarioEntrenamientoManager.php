<?php


namespace App\Service\Managers\User;



use App\DTO\TestUsuario\TestUsuarioEntrenamientoCreateDTO;
use App\Entity\TestUsuario;
use App\Service\Managers\AbstractManager;
use Doctrine\Common\Persistence\ObjectRepository;
use phpDocumentor\Reflection\Types\Integer;

class TestUsuarioEntrenamientoManager extends AbstractManager
{

    /**
     * @return ObjectRepository
     */
    protected function getRepository()
    {
        return $this->doctrine->getRepository(TestUsuario::class);
    }
    public function createtest_usuario(TestUsuarioEntrenamientoCreateDTO $DTO){

        $usuario = $DTO->getUser();
        $test_usuario = new TestUsuario();
        $test_usuario->setUser($usuario);
        $test_usuario->setExperienciaDeporte($DTO->getDiasEntrenamiento());
        $test_usuario->setFrecuenciaEntrenamiento($this->decisionFrecuenciaEntrenamiento($DTO->getDiasEntrenamiento()));
        $test_usuario->setFormaFisica($DTO->getFormaFisica());


    }
    public function decisionFrecuenciaEntrenamiento(array $dias){
        /** @var array $cantidad */
        $cantidad = count($dias) ;
        switch ($cantidad){
            case 1:
                $frecuencia="muy baja";
                break;
            case 2:
                $frecuencia="baja";
                break;
            case 3:
                $frecuencia="Media";
                break;
            case 4 or 5:
                $frecuencia="Alta";
                break;
            default:
                $frecuencia="nula";

        }
        return $frecuencia;
    }

}
