<?php

namespace App\Tests\User;

use App\Entity\Cliente;
use App\Entity\Role;
use App\Entity\User;
use App\Tests\api\BaseApiTestBase;
use App\Tests\ApiTester;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;

class ClienteTestCest extends BaseApiTestBase
{

    protected $role_uuid;


    public function _before(ApiTester $I)
    {
        $this->auth($I, Role::ROLE_AUDITOR_ADMIN);
        $this->current($I);
    }

    public function _after(ApiTester $I)
    {
    }

    public function tryToTest(ApiTester $I)
    {
    }

    public function clienteAdminCanCreateClientes(ApiTester $I)
    {
        $I->wantToTest(Role::ROLE_AUDITOR_ADMIN . ' puede crear clientes');
        $this->auth($I, Role::ROLE_AUDITOR_ADMIN);
        $I->amBearerAuthenticated($this->token);
        $request = [
            'nombre' => 'Pedro Perez',
            'uuid' => Uuid::uuid4()->toString(),
            'username' => 'cliente_test',
            'email' => 'cliente_test@email.com',
            'password' => 'simple_password'
        ];

        $I->sendPOST('api/clientes', json_encode($request));
        $I->seeResponseCodeIs(Response::HTTP_CREATED);

        $I->canSeeInRepository(Cliente::class, ['uuid' => $request['uuid']]);
    }
}
