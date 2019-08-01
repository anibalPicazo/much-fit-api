<?php

namespace App\Tests\api;

use App\Entity\Role;
use App\Entity\User;
use App\Tests\ApiTester;

/**
 * Class BaseApiTestBase
 * @package App\Tests\api
 * @see https://codeception.com/docs/10-WebServices#Testing-JSON-Responses
 * @see https://codeception.com/docs/modules/Doctrine2
 */
class BaseApiTestBase
{

    protected $token, $user;

    public function _before(ApiTester $I)
    {
    }

    public function _after(ApiTester $I)
    {
    }

    protected function auth(ApiTester $I, $role = Role::ROLE_ROOT)
    {
        $this->login($I, $role);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseJsonMatchesJsonPath('token');

        $token = $I->grabDataFromResponseByJsonPath('token');
        $this->token = $token[0];

    }

    public function login(ApiTester $I, $role)
    {
        switch ($role) {
            case Role::ROLE_ROOT:
                $user = ['username' => 'admin', 'password' => 'admin'];
                break;
            case Role::ROLE_AUDITOR_ADMIN:
                $roleUuid = $I->grabFromRepository(Role::class, 'uuid', ['name' => Role::ROLE_AUDITOR_ADMIN]);
                $users = $I->grabEntitiesFromRepository(User::class, ['roles' => ['uuid' => $roleUuid]]);
                $user = ['username' => $users[0]->getUsername(), 'password' => $users[0]->getUsername()];
                break;
            case Role::ROLE_AUDITOR:
                $roleUuid = $I->grabFromRepository(Role::class, 'uuid', ['name' => Role::ROLE_AUDITOR]);
                $users = $I->grabEntitiesFromRepository(User::class, ['roles' => ['uuid' => $roleUuid]]);
                $user = ['username' => $users[0]->getUsername(), 'password' => $users[0]->getUsername()];
                break;
            case Role::ROLE_AUDITOR_FREELANCE:
                $roleUuid = $I->grabFromRepository(Role::class, 'uuid', ['name' => Role::ROLE_AUDITOR_FREELANCE]);
                $users = $I->grabEntitiesFromRepository(User::class, ['roles' => ['uuid' => $roleUuid]]);
                $user = ['username' => $users[0]->getUsername(), 'password' => $users[0]->getUsername()];
                break;
            default:
                $user = ['username' => 'admin', 'password' => 'admin'];
        }
        $I->sendPOST('api/auth', json_encode($user));
    }

    protected function current(ApiTester $I)
    {
        $I->amBearerAuthenticated($this->token);
        $I->sendGET('api/users/current');
        $I->seeResponseIsJson();
        $I->seeResponseJsonMatchesJsonPath('username');
        $this->user = json_decode($I->grabResponse(), true);
        return $this->user;
    }


}
