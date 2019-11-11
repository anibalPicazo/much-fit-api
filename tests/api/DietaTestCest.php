<?php


namespace App\Tests\api;
use App\Entity\Role;
use App\Tests\api\BaseApiTestBase;
use App\Tests\ApiTester;
use Faker\Factory;
use Faker\Generator;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;

class DietaTestCest extends BaseApiTestBase
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
     */
    public function adminCanListDietas(ApiTester $I)
    {
        $I->wantToTest(Role::ROLE_ROOT . ' puede listar dietas');
        $this->auth($I, Role::ROLE_ROOT);
        $I->amBearerAuthenticated($this->token);
        $I->sendGET('api/dietas');
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->seeResponseIsJson();
        $I->seeResponseJsonMatchesJsonPath('$[0].descripcion');
    }

//    /**
//     * @param ApiTester $I
//     * @throws \Exception
//     */
//    public function adminCanCreateDietas(ApiTester $I)
//    {
//        $I->wantToTest(Role::ROLE_ROOT . ' puede crear dietas');
//        $this->auth($I, Role::ROLE_AUDITOR_ADMIN);
//        $I->amBearerAuthenticated($this->token);
//        $request = [
//            'uuid' => Uuid::uuid4()->toString(),
//            'descripcion' => 'Dieta Test',
//            'aporte_calorico' => 'address test',
//            'lat' => '-32.931839',
//            'lng' => '-60.8950737'
//        ];
//
//        $I->sendPOST('api/delegaciones', json_encode($request));
//        $I->seeResponseCodeIs(Response::HTTP_CREATED);
//        $I->canSeeInRepository(Delegacion::class, ['uuid' => $request['uuid']]);
//    }


}
