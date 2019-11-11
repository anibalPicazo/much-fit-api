<?php


namespace App\Tests\api;


use App\Entity\Role;
use App\Entity\Rutina;
use App\Entity\User;
use App\Tests\ApiTester;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;

class PruebaEntrenamientoTestCest extends BaseApiTestBase
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
    public function adminCanListRutinas(ApiTester $I)
    {
        $I->wantToTest(Role::ROLE_USER . ' puede crear test de entrenamientos');
        $this->auth($I, Role::ROLE_USER);
        $I->amBearerAuthenticated($this->token);
        $request = [
                'uuid' => Uuid::uuid4()->toString(),
                'experiencia_deporte' => "De dos a ocho meses",
                'forma_fisica' => "bueno",
                'frecuencia' => "Más de 3 días",
                'objetivo'  => "hipertrofia"
        ];

        $I->sendPOST('api/test_entrenamientos', json_encode($request));
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $rutina= $I->grabFromRepository(Rutina::class,'id',['nombre' => 'aclimatacion']);
        $I->canSeeInRepository(User::class, ['rutina' => $rutina]);
    }


}
