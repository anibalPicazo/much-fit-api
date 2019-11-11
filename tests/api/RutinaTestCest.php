<?php


namespace App\Tests\api;


use App\Entity\Dia;
use App\Entity\DiaEjercicio;
use App\Entity\Ejercicios;
use App\Entity\Pais;
use App\Entity\Role;
use App\Entity\Rutina;
use App\Tests\ApiTester;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;

class RutinaTestCest extends BaseApiTestBase
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
    public function adminCanListRutinas(ApiTester $I)
    {
        $I->wantToTest(Role::ROLE_ROOT . ' puede listar rutinas');
        $this->auth($I, Role::ROLE_ROOT);
        $I->amBearerAuthenticated($this->token);
        $I->sendGET('api/rutinas');
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->seeResponseIsJson();
        $I->seeResponseJsonMatchesJsonPath('$[0].nombre');
    }

    /**
     * @param ApiTester $I
     * @throws \Exception
     */
    public function adminCanCreateDietas(ApiTester $I)
    {
        $I->wantToTest(Role::ROLE_ROOT . ' puede crear rutinas');
        $this->auth($I, Role::ROLE_ROOT);
        $I->amBearerAuthenticated($this->token);
        $request = [

            'uuid' => Uuid::uuid4()->toString() ,
            'nombre' => "Rutina Full Body 3 dias",
            'desgaste_calorico' => "920",
            'dificultad_usuario' => "MEDIA",
            'frecuencia' => 3,
            'volumen' => 48,
            'intensidad' => 'Alta',
            'objetivo' => "Ganancia muscular"

        ];

        $I->sendPOST('api/rutinas', json_encode($request));
        $I->seeResponseCodeIs(Response::HTTP_CREATED);
        $I->canSeeInRepository(Rutina::class, ['uuid' => $request['uuid']]);
    }
    /**
     * @param ApiTester $I
     * @throws \Exception
     */
    public function adminCanNotCreateDietas(ApiTester $I)
    {
        $I->wantToTest(Role::ROLE_ROOT . ' no puede crear rutinas, por un error de validacion');
        $this->auth($I, Role::ROLE_ROOT);
        $I->amBearerAuthenticated($this->token);
        $request = [

            'uuid' => Uuid::uuid4()->toString() ,
            'nombre' => "Rutina Full Body 3 dias",
            'desgaste_calorico' => "920",
            'dificultad_usuario' => "MEDIA",
            'frecuencias' => "erro validacion",
            'volumen' => 48,
            'intensidad' => 'Alta',
            'objetivo' => "Ganancia muscular"

        ];

        $I->sendPOST('api/rutinas', json_encode($request));
        $I->seeResponseCodeIs(Response::HTTP_BAD_REQUEST);
        $I->cantSeeInRepository(Rutina::class, ['uuid' => $request['uuid']]);
    }
    public function cancreateDiaRutina(ApiTester $I){

        $I->wantToTest(Role::ROLE_ROOT . ' puede crear un dia de la rutina');
        $this->auth($I, Role::ROLE_ROOT);
        $I->amBearerAuthenticated($this->token);
        /** @var Rutina $rutina */
        $rutina = $I->grabEntitiesFromRepository(Rutina::class)[0];
        $request = [

            'uuid' => Uuid::uuid4()->toString() ,
            'nombre' => "Lunes",
            'rutina' => $rutina->getUuid()


        ];

        $I->sendPOST('api/rutinas/'.$rutina->getUuid().'/dias', json_encode($request));
        $I->seeResponseCodeIs(Response::HTTP_CREATED);
        $I->canSeeInRepository(Dia::class, ['uuid' => $request['uuid']]);
    }
    public function cancreateDiaEjercicio(ApiTester $I){

        $I->wantToTest(Role::ROLE_ROOT . ' puede crear un dia ejercicio de la rutina');
        $this->auth($I, Role::ROLE_ROOT);
        $I->amBearerAuthenticated($this->token);
        /** @var Rutina $rutina */
        $rutina = $I->grabEntitiesFromRepository(Rutina::class)[0];
        $ejercicio = $this->faker->randomElement($I->grabEntitiesFromRepository(Ejercicios::class));
        $dia = $rutina->getDia()->first();
        $request = [

            'uuid' => Uuid::uuid4()->toString() ,
            'serie' => "Serie 1 Press Banca",
            'ejercicio' => $ejercicio->getUuid(),
            'intesidad' => " 1",
            'descanso' => "30",
            'repeticiones' => 1,
            'dia' => $dia->getUuid()

        ];

        $I->sendPOST('api/rutinas/'.$rutina->getUuid().'/dias/'.$dia->getUuid().'/ejercicios', json_encode($request));
        $I->seeResponseCodeIs(Response::HTTP_CREATED);
        $I->canSeeInRepository(DiaEjercicio::class, ['uuid' => $request['uuid']]);
    }

}
