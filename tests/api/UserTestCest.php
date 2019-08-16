<?php

namespace App\Tests\User;

use App\Entity\Role;
use App\Tests\api\BaseApiTestBase;
use App\Tests\ApiTester;
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

    public function tryToTest(ApiTester $I)
    {
    }

    public function adminCanLogin(ApiTester $I)
    {
        $I->wantToTest('Admin can login');
        $this->auth($I, Role::ROLE_ROOT);
        $I->amBearerAuthenticated($this->token);
        $I->sendGet('api/users/current');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $this->user = $I->grabResponse();

    }


}
