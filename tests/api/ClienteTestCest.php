<?php

namespace App\Tests\User;

use App\Entity\Cliente;
use App\Entity\Role;
use App\Tests\api\BaseApiTestBase;
use App\Tests\ApiTester;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;

class ClienteTestCest extends BaseApiTestBase
{

    protected $role_uuid;


    public function _before(ApiTester $I)
    {
    }

    public function _after(ApiTester $I)
    {
    }

    public function tryToTest(ApiTester $I)
    {
    }

    public function clienteAdminCanCreateClientes(ApiTester $I)
    {
        $uuid = Uuid::uuid4()->toString();
        $I->wantToTest(Role::ROLE_AUDITOR_ADMIN . ' puede crear cliente');
        $this->auth($I, Role::ROLE_AUDITOR_ADMIN);
        $I->amBearerAuthenticated($this->token);
        $request = [
            'uuid' => $uuid,
            'nombre' => $this->faker->userName,
            'username' => $this->faker->userName,
            'email' => $this->faker->email,
            'password' => '_password'
        ];
        $I->sendPOST('api/clientes', json_encode($request));
        $I->seeResponseCodeIs(Response::HTTP_CREATED);
        $I->canSeeInRepository(Cliente::class, ['uuid' => $request['uuid']]);
    }

    public function listarClientes(ApiTester $I)
    {
        $I->wantToTest(Role::ROLE_AUDITOR_ADMIN . ' puede listar clientes.');
        $this->auth($I, Role::ROLE_AUDITOR_ADMIN);
        $I->amBearerAuthenticated($this->token);

        $I->sendGET('api/clientes');
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->seeResponseJsonMatchesJsonPath('$[0].uuid');
    }
}
