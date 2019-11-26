<?php

namespace App\Tests\User;

use App\Entity\Role;
use App\Tests\api\BaseApiTestBase;
use App\Tests\ApiTester;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;

class UserTestCest extends BaseApiTestBase
{

    protected $role_uuid;


    public function _before(ApiTester $I)
    {
    }

    public function _after(ApiTester $I)
    {
    }

    public function adminCangetCurrentUser(ApiTester $I)
    {
        $I->wantToTest('Admin can get current user');
        $this->auth($I, Role::ROLE_ROOT);
        $I->amBearerAuthenticated($this->token);
        $I->sendGet('api/users/current');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $this->user = $I->grabResponse();

    }
    public function userCanRegister(ApiTester $I)
    {
        $I->wantToTest(Role::ROLE_USER .' puede registrarse');

        $request = [
            'uuid' => Uuid::uuid4()->toString(),
            'username'=> "apicazo",
            'password' => 'apicazo',
            'name' => "Anibal",
            'surname' => "Picazo",
            'email' => "anibdal.picazo@hotmail.com"
        ];
        $I->sendPOST('/register', json_encode($request));
        $I->seeResponseCodeIs(200);
    }
    public function userCanSeeRutina(ApiTester $I)
    {
        $I->wantToTest(Role::ROLE_USER .' puede ver su rutina asignada');
        $this->auth($I, Role::ROLE_ROOT);
        $I->amBearerAuthenticated($this->token);
        $I->sendGET('api/users/'.$this->current($I)['uuid'].'/rutina');
        $I->seeResponseCodeIs(200);
    }
    public function userCanSeeDieta(ApiTester $I)
    {
        $I->wantToTest(Role::ROLE_USER .' puede ver su dieta asignada');
        $this->auth($I, Role::ROLE_ROOT);
        $I->amBearerAuthenticated($this->token);
        $I->sendGET('api/users/'.$this->current($I)['uuid'].'/dieta');
        $I->seeResponseCodeIs(200);
    }



}
