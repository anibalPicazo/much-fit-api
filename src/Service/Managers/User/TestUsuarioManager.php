<?php


namespace App\Service\Managers\User;



use App\DTO\test_usuario\test_usuarioCreateDTO;
use App\Entity\test_usuario;
use App\Entity\TestUsuario;
use App\Service\Managers\AbstractManager;
use Doctrine\Common\Persistence\ObjectRepository;
use phpDocumentor\Reflection\Types\Integer;

class test_usuarioManager extends AbstractManager
{

    /**
     * @return ObjectRepository
     */
    protected function getRepository()
    {
        return $this->doctrine->getRepository(test_usuario::class);
    }
    public function createtest_usuario(test_usuarioCreateDTO $DTO){

        $usuario = $DTO->getUser();
        $test_usuario = new TestUsuario();
        $test_usuario->setUser($usuario);
        $test_usuario->setPeso($DTO->getPeso());
        $test_usuario->setAltura($DTO->getAltura());
        $test_usuario->setGenero($DTO->getGenero());

        $test_usuario->setFrecuenciaEntrenamiento($this->decisionFrecuenciaEntrenamiento($DTO->getDiasEntrenamiento()));
        $test_usuario->setCeliaco($DTO->getCeliaco());
        $test_usuario->setDiabetico($DTO->getDiabetico());




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
