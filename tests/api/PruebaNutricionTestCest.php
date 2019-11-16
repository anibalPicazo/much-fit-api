<?php


namespace App\Tests\api;


use App\Entity\Dieta;
use App\Entity\Role;
use App\Entity\Rutina;
use App\Entity\User;
use App\Tests\ApiTester;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;

class PruebaNutricionTestCest extends BaseApiTestBase
{
    protected $role_uuid;


    public function _before(ApiTester $I)
    {
    }

    public function _after(ApiTester $I)
    {
    }

    /**
     * @param ApiTester $I
     * @throws \Exception
     */
    public function usuarioPuedeCrearTestNutricion(ApiTester $I)
    {
        $I->wantToTest(Role::ROLE_USER . ' puede crear test de nutricion');
        $this->auth($I, Role::ROLE_USER);
        $I->amBearerAuthenticated($this->token);
        $request = [
            'uuid' => Uuid::uuid4()->toString(),
            'altura' => 171,
            'edad' => 27,
            'genero'=> "Hombre",
            'imc' => "",
            'grasa' => 11,
            'peso' => 61,
            'estado_fisico' => "Tasado",
            'estado_fisico_objetivo' => "Definido",
            'actividad_fisica'=> "Muy activo",
            'experiencia' => 'Más de un año'
        ];

        $I->sendPOST('api/test_nutricion', json_encode($request));
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $dieta= $I->grabFromRepository(Dieta::class,'id',['descripcion' => 'hipocalorica']);
        $I->canSeeInRepository(User::class, ['dieta' => $dieta]);
    }


}
