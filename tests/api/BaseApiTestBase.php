<?php

namespace App\Tests\api;

use App\Entity\Role;
use App\Entity\User;
use App\Tests\ApiTester;
use Faker\Factory;
use Faker\Generator;

/**
 * Class BaseApiTestBase
 * @package App\Tests\api
 * @see https://codeception.com/docs/10-WebServices#Testing-JSON-Responses
 * @see https://codeception.com/docs/modules/Doctrine2
 */
class BaseApiTestBase
{

    /** @var Generator */
    protected $faker;
    protected $token, $user;

    /**
     * BaseApiTestBase constructor.
     */
    public function __construct()
    {
        $this->faker = Factory::create('es_ES');
    }

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
            case Role::ROLE_USER:
                $user = ['username' => 'demo', 'password' => 'admin'];
                break;

            default:
                $user = ['username' => 'admin', 'password' => 'admin'];
                break;
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

    protected function getCollectionResponse(ApiTester $I, $name): array
    {
        $I->sendGET("api/{$name}");
        return \GuzzleHttp\json_decode($I->grabResponse(), true);
    }

    protected function grabJSONResponse($I)
    {
        return \GuzzleHttp\json_decode($I->grabResponse(), true);
    }

}
