# Inicializar el proyecto

Clonamos desde gitlab el proyecto.

```
git clone git@gitlab.com:kaamit/certiapp/certiapp-api.git
```
## Claves JWT
Añadimos las claves para la autenticación JWT teniendo en cuenta que la contraseña debe de coincidir con el nombre de la contraseña que tengamos en nuestro .env o .env.local **'JWT_PASSPHRASE'**. Desde el root del proyecto ejecutamos:
```
$ mkdir -p config/jwt # For Symfony3+, no need of the -p option
$ openssl genrsa -out config/jwt/private.pem -aes256 4096
$ openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
```
## Bases de datos
El proyecto utiliza dos bases de datos para desarrollo en local **'certiapp_dev'** y **'certiapp_test'**.En el root del proyecto tenemos dos archivos **'docker-compose-full.yml'** y **'docker-compose-mysql.yml'**. El primero nos crea contenedores de **NGINX, PHP y MYSQL** y el segundo solamente de **MYSQL**. Para crearlos debemos de tener instalado docker y docker-compose, podéis descargarlo desde aquí https://docs.docker.com/v17.12/install/ y descargar Docker for Desktop según tengamos **Windows** o **Mac**, para **Linux** lo podemos instalar desde la linea de comandos ya que es nativo.

La base de datos certiapp_dev se crea automaticamente cuando ejecutamos docker pero la de test 'certiapp_test' hay que crearla manualmente mediante root y asignarle los permisos para el usuario **kaam**

El comando para ejecutar docker desde el root del proyecto es:

```
docker-compose -f docker-compose-full.yml up --build
```

# Nuestro primer controlador

Primero instalamos todas las dependencias.

```
composer install
```

## DTO (Data Transfer Object)

Cada caso de uso tendrá su DTO. En ésta clase es donde validamos y mapeamos los datos de entrada de la llamada. Mediante anotaciones asssert validamos y mediante 
MSSerializer\Type definimos el tipo y mapeamos a objetos de la base de datos en algunos casos.

Tipos de @JMSSerializer\Type:

* Los básicos, string, integer, etc..
* Propios del API.
    * @JMSSerializer\Type("Entity<App\Entity\User>") => entidad de la base de datos.
    * @JMSSerializer\Type("Entity<App\Entity\Role,collection>") => colección de entidades de la base de datos.

A tener en cuenta, las propiedades de la clase deben de ser **protected** y **private** las que sean de **@JMSSerializer\Type**

```php
//src/DTO/Auditor/AuditorCreateDTO.php
<?php


namespace App\DTO\Auditor;

use App\DTO\DTOInterface;
use JMS\Serializer\Annotation as JMSSerializer;
use Symfony\Component\Validator\Constraints as Assert;


class AuditorCreateDTO implements DTOInterface
{
    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $nombre;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $iniciales;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $uuid;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $username;

    /**
     * @Assert\NotNull()
     * @Assert\Email()
     * @JMSSerializer\Type("string")
     */
    protected $email;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $password;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("Entity<App\Entity\Role,collection>")
     */
    private $roles;


    /**
     * AuditorCreateDTO constructor.
     * @param $uuid
     * @param $username
     * @param $email
     * @param $password
     * @param $nombre
     * @param $iniciales
     * @param $roles
     */
    public function __construct($uuid, $username, $email, $password, $nombre, $iniciales, $roles)
    {
        $this->nombre = $nombre;
        $this->iniciales = $iniciales;
        $this->uuid = $uuid;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->roles = $roles;
    }


    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @return mixed
     */
    public function getIniciales()
    {
        return $this->iniciales;
    }


    /**
     * @return mixed
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }


}
```
### Controller

En cada metodo podremos utilizar anotaciones para definir:

    * @Route("/{uuid}/change-password",  methods={"POST"})  //definicion de la ruta.
    * @View(serializerGroups={"list","edit"})  //propiedes de cada entidad que que devuelve la llamada.
    * @ParamConverter("DTO", converter="api.rest.dto.converter")  //nos convierte el DTO a objetos.
    * @SWG\Tag(name="Auditor")  //anotación para gestionar la documentacion

Los puntos básicos de cada metodo son:

    * Security //controlamos la seguridad y permisos.
    * Validation  // Validación de las propiedades del DTO
    * Command // Comando (acción, lógica) a realizar en la llamada.
    * Event  // Evento que lanza la llamada.
    * Response  // Respuesta devuelta al front.

```php
//src/Controller/Auditor/AuditorController.php
<?php

namespace App\Controller\Auditor;

use App\DTO\Auditor\AuditorCambiarPasswordDTO;
use App\DTO\Auditor\AuditorCreateDTO;
use App\DTO\Auditor\AuditorEditDTO;
use App\Entity\Auditor;
use App\Entity\Role;
use App\Entity\User;
use App\EventSubscriber\Event\AuditorEvent;
use App\Form\AuditorType;
use App\Security\Voter\AuditorVoter;
use App\Service\Managers\Auditor\AuditorManager;
use App\Service\Managers\User\UserManager;
use App\Validator\DTOValidator;
use Doctrine\Common\Collections\Collection;
use FOS\RestBundle\Controller\Annotations\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

/**
 * @Route("/auditores")
 */
class AuditorController extends AbstractController
{
    /**
     * @var DTOValidator
     */
    protected $DTOValidator;
    /**
     * @var AuditorManager
     */
    protected $manager;
    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * UserController constructor.
     * @param DTOValidator $DTOValidator
     * @param AuditorManager $manager
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(DTOValidator $DTOValidator, AuditorManager $manager, EventDispatcherInterface $dispatcher)
    {
        $this->DTOValidator = $DTOValidator;
        $this->manager = $manager;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @Route("/{uuid}", methods={"GET"})
     * @View(serializerGroups={"list", "edit"})
     * @ParamConverter("auditor", options={"mapping": {"uuid": "uuid"}})
     * @param Auditor $auditor
     * @return Auditor
     *
     * @SWG\Tag(name="Auditor")
     * @SWG\Response(
     *     response=200,
     *     description=""
     * )
     */
    public function getOne(Auditor $auditor)
    {
        // SECURITY
        $this->denyAccessUnlessGranted(AuditorVoter::VIEW, $auditor);

        return $auditor;

    }

    /**
     * @Route("", methods={"GET"})
     * @View(serializerGroups={"list"})
     * @return Auditor[]|Collection
     *
     * @SWG\Tag(name="Auditor")
     * @SWG\Response(
     *     response=200,
     *     description=""
     * )
     */
    public function list()
    {
        // SECURITY
        $this->denyAccessUnlessGranted(Role::ROLE_AUDITOR_ADMIN);

        // COMMAND
        /** @var User $user */
        $user = $this->getUser();
        $auditores = $user->getEmpresa()->getAuditores();

        //RESPONSE
        return $auditores;
    }

    /**
     * @Route("/{uuid}/change-password",  methods={"POST"})
     * @View(serializerGroups={"list","edit"})
     * @param AuditorCambiarPasswordDTO $DTO
     * @param Request $request
     * @return Auditor|JsonResponse|null
     * @throws ExceptionInterface
     * @ParamConverter("DTO", converter="api.rest.dto.converter")
     *
     * @SWG\Tag(name="Auditor")
     * @SWG\Response(
     *     response=200,
     *     description=""
     * )
     * @SWG\Parameter(
     *     in="body",
     *     name="DTO",
     *     @SWG\Schema(
     *         type="object",
     *         ref=@Model(type=AuditorCambiarPasswordDTO::class)
     *     )
     * )
     */
    public function changePassword(AuditorCambiarPasswordDTO $DTO, Request $request)
    {
        // SECURITY
        $this->denyAccessUnlessGranted(Role::ROLE_AUDITOR_FREELANCE);

        //VALIDATION
        $errors = $this->DTOValidator->validate($request);
        if ($errors) {
            return new JsonResponse($errors, Response::HTTP_BAD_REQUEST);
        }

        //COMMAND
        $auditor = $this->manager->changePassword($DTO);

        //EVENT
        $event = new AuditorEvent($DTO);
        $this->dispatcher->dispatch($event, AuditorEvent::AUDITOR_PASSWORD_CHANGED);

        //RESPONSE
        return $auditor;
    }


    /**
     * @Route("", methods={"POST"})
     * @View(serializerGroups={"list","edit"})
     * @param AuditorCreateDTO $DTO
     * @param Request $request
     * @param UserManager $userManager
     * @return JsonResponse
     * @throws ExceptionInterface
     * @ParamConverter("DTO", converter="api.rest.dto.converter")
     *
     * @SWG\Tag(name="Auditor")
     * @SWG\Response(
     *     response=201,
     *     description=""
     * )
     * @SWG\Parameter(
     *     in="body",
     *     name="DTO",
     *     @SWG\Schema(
     *         type="object",
     *         ref=@Model(type=AuditorCreateDTO::class)
     *     )
     * )
     * @Security(name="Bearer")
     */
    public function crear(AuditorCreateDTO $DTO, Request $request, UserManager $userManager)
    {
        // SECURITY
        $this->denyAccessUnlessGranted(Role::ROLE_AUDITOR_ADMIN);

        //VALIDATION
        $errors = $this->DTOValidator->validate($request);
        if ($errors) {
            return new JsonResponse($errors, Response::HTTP_BAD_REQUEST);
        }

        //COMMAND
        $this->manager->createAuditor($DTO, $userManager);

        //EVENT
        $event = new AuditorEvent($DTO);
        $this->dispatcher->dispatch($event, AuditorEvent::AUDITOR_CREATED);

        //RESPONSE
        return new JsonResponse(null, Response::HTTP_CREATED);
    }

    /**
     * @Route("/{uuid}", methods={"PATCH"})
     * @View(serializerGroups={"list","edit"})
     * @param AuditorEditDTO $DTO
     * @param Request $request
     * @return JsonResponse
     * @throws ExceptionInterface
     * @throws \ReflectionException
     * @ParamConverter("DTO", converter="api.rest.dto.converter")
     *
     * @SWG\Tag(name="Auditor")
     * @SWG\Response(
     *     response=200,
     *     description=""
     * )
     * @SWG\Parameter(
     *     in="body",
     *     name="DTO",
     *     @SWG\Schema(
     *         type="object",
     *         ref=@Model(type=AuditorEditDTO::class)
     *     )
     * )
     * @Security(name="Bearer")
     */
    public function edit(AuditorEditDTO $DTO, Request $request)
    {
        // SECURITY
        $this->denyAccessUnlessGranted(Role::ROLE_AUDITOR_FREELANCE);

        //VALIDATION
        $errors = $this->DTOValidator->validate($request);
        if ($errors) {
            return new JsonResponse($errors, Response::HTTP_BAD_REQUEST);
        }

        //COMMAND
        $form = $this->createForm(AuditorType::class, $DTO->getAuditor());
        $entity = $this->manager->processDTOForm($DTO, $form, $request->getMethod());

        //RESPONSE
        return new JsonResponse($entity);

    }


    /**
     * @Route("/{uuid}",  methods={"DELETE"})
     * @ParamConverter("auditor", options={"mapping": {"uuid": "uuid"}})
     * @param Auditor $auditor
     * @return JsonResponse
     *
     * @SWG\Tag(name="Auditor")
     * @SWG\Response(
     *     response=200,
     *     description=""
     * )
     */
    public function delete(Auditor $auditor)
    {
        // SECURITY
        $this->denyAccessUnlessGranted(AuditorVoter::DELETE, $auditor);

        //COMMAND
        $this->manager->remove($auditor);

        //RESPONSE
        return new JsonResponse(null, Response::HTTP_OK);
    }
}
```

## SECURITY

Para la seguridad utilizaremos :
* $this->denyAccessUnlessGranted(Role::ROLE_AUDITOR_FREELANCE);
* $this->denyAccessUnlessGranted(AuditorVoter::DELETE, $auditor);

El segundo caso es para cuando necesitamos logica mas compleja como comprobar que solo se pueden editar usuario que pertencen a la misma empresa del usuario logeado, por ejemplo.

Un ejemplo de dicho voter:

```php
// src/Security/Voter/AuditorVoter.php
<?php


namespace App\Security\Voter;


use App\Entity\Auditor;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class AuditorVoter extends Voter
{
    const VIEW = "view";
    const EDIT = "edit";
    const DELETE = "delete";

    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, [self::VIEW, self::EDIT])) {
            return false;
        }

        if (!$subject instanceof Auditor) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $current_user = $token->getUser();

        if (!$current_user instanceof User) {
            return false;
        }

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($subject, $current_user);
            case self::EDIT:
                return $this->canEdit($subject, $current_user);
            case self::DELETE:
                return $this->canEdit($subject, $current_user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(Auditor $auditor, User $current_user)
    {
        if ($this->canEdit($auditor, $current_user)) {
            return true;
        }

        return $current_user->getEmpresa()->getAuditores()->contains($auditor);
    }

    private function canEdit(Auditor $auditor, User $current_user)
    {
        return $current_user->getEmpresa()->getAuditores()->contains($auditor);
    }

}

```

## VALIDATION

Siempre tendremos que utilizar el siguiente codigo en cualquier controlador.
```php
//VALIDATION
$errors = $this->DTOValidator->validate($request);
if ($errors) {
    return new JsonResponse($errors, Response::HTTP_BAD_REQUEST);
}

```

## COMMAND
El comando se programa en el manager de cada entidad. Mediante inyección de dependencias inyectaremos aquellos servicios que necesitemos para realizar el comando. Cualquier manager extiende de la clase abstracta **AbstractManager** la cual fuerza a definir siempre un único método:

```php
/**
* @return RoleRepository|ObjectRepository
*/
protected function getRepository()
{
return $this->doctrine->getRepository(Auditor::class);
}
```

Aquí un ejemplo de AuditorManager

```php
//  src/Service/Managers/Auditor/AuditorManager.php
<?php


namespace App\Service\Managers\Auditor;


use App\DTO\Auditor\AuditorCambiarPasswordDTO;
use App\DTO\Auditor\AuditorCreateDTO;
use App\Entity\Auditor;
use App\Entity\User;
use App\EventSubscriber\Event\AuditorEvent;
use App\Repository\RoleRepository;
use App\Serializer\ApiRestErrorNormalizer;
use App\Service\Forms\DTOFormFactory;
use App\Service\Managers\AbstractManager;
use App\Service\Managers\User\UserManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AuditorManager extends AbstractManager
{
    /**
     * @var UserPasswordEncoderInterface
     */
    protected $encoder;


    /**
     * AuditorManager constructor.
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder, ApiRestErrorNormalizer $normalizer, DTOFormFactory $formFactory, EntityManagerInterface $doctrine, TokenStorageInterface $tokenStorage)
    {
        $this->encoder = $encoder;
        parent::__construct($normalizer, $formFactory, $doctrine, $tokenStorage);
    }

    /**
     * @param AuditorCreateDTO $DTO
     * @param UserManager $userManager
     * @return Auditor
     */
    public function createAuditor(AuditorCreateDTO $DTO)
    {
        $auditor = new Auditor();
        $auditor->setUuid($DTO->getUuid());
        $auditor->setNombre($DTO->getNombre());
        $auditor->setIniciales($DTO->getIniciales());

        /** @var User $user */
        $current_user = $this->tokenStorage->getToken()->getUser();
        $auditor->setEmpresa($current_user->getEmpresa());

        $this->doctrine->persist($auditor);
        $this->doctrine->flush();

        return $auditor;
    }

    /**
     * @param AuditorCambiarPasswordDTO $DTO
     * @return Auditor|null
     */
    public function changePassword(AuditorCambiarPasswordDTO $DTO)
    {
        /** @var Auditor $auditor */
        $auditor = $DTO->getAuditor();
        $user = $auditor->getUser();
        $user->setPassword($this->encoder->encodePassword($user, $DTO->getPassword()));

        $this->doctrine->persist($user);
        $this->doctrine->flush();

        return $auditor;
    }

    /**
     * @return RoleRepository|ObjectRepository
     */
    protected function getRepository()
    {
        return $this->doctrine->getRepository(Auditor::class);
    }
}

```

## EVENT

Prácticamente cada caso de uso lanza un evento que siempre llevará adjunto el DTO de ése caso de uso. Los nombres de eventos estarán escritos en pasado y en minusculas con el formaro **entity.action** por normalización. Por ejemplo para crear un auditor lanzamos el evento **"auditor.created"**. Tened en cuenta que cuando se crea un auditor hay que crear un usuario y asociarle el auditor, pero ésta logica no se programam en el comando sino en el subscriptor que se ha suscrito al evento de **auditor.created**. Veamos el ejemplo completo.

### Clase AuditorEvent

```php
// src/EventSubscriber/Event/AuditorEvent.php
<?php

namespace App\EventSubscriber\Event;

use App\DTO\DTOInterface;
use Symfony\Contracts\EventDispatcher\Event;

final class AuditorEvent extends Event
{

    const AUDITOR_CREATED = "auditor.created";
    const AUDITOR_PASSWORD_CHANGED = "auditor.change_password";

    /**
     * @var DTOInterface
     */
    private $DTO;

    /**
     * ArticleEvent constructor.
     * @param DTOInterface $DTO
     */
    public function __construct($DTO)
    {
        $this->DTO = $DTO;
    }

    /**
     * @return DTOInterface
     */
    public function getDTO(): DTOInterface
    {
        return $this->DTO;
    }
}
```

### Suscriptor encargado de guardar el evento y crear el usuario adjunto.

Aquí programamos la lógica que es consecuencia de un caso de uso. Por ejemplo, crear un usuario cuando se crea un auditor, enviar un email al cliente, ect.

```php

<?php


namespace App\EventSubscriber\Subscriber;


use App\DTO\Auditor\AuditorCambiarPasswordDTO;
use App\DTO\Auditor\AuditorCreateDTO;
use App\DTO\User\UserCreateDTO;
use App\Entity\Auditor;
use App\Entity\User;
use App\EventSubscriber\Event\AuditorEvent;
use App\EventSubscriber\Event\UserEvent;
use App\Service\Events\EventStore;
use App\Service\Managers\Auditor\AuditorManager;
use App\Service\Managers\User\RoleManager;
use App\Service\Managers\User\UserManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AuditorSubscriber implements EventSubscriberInterface
{
    /**
     * @var EventStore
     */
    protected $eventStore;
    /**
     * @var UserManager
     */
    protected $userManager;
    /**
     * @var AuditorManager
     */
    protected $auditorManager;
    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * AuditorSubscriber constructor.
     * @param EventStore $eventStore
     * @param UserManager $userManager
     * @param AuditorManager $auditorManager
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(EventStore $eventStore, UserManager $userManager, AuditorManager $auditorManager, EventDispatcherInterface $dispatcher)
    {
        $this->eventStore = $eventStore;
        $this->userManager = $userManager;
        $this->auditorManager = $auditorManager;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            AuditorEvent::AUDITOR_CREATED => 'onAuditorCreated',
            AuditorEvent::AUDITOR_PASSWORD_CHANGED => 'onPasswordChanged',
        ];
    }

    public function onPasswordChanged(AuditorEvent $event)
    {
        /** @var AuditorCambiarPasswordDTO $DTO */
        $DTO = $event->getDTO();
        $this->eventStore->saveEvent(AuditorEvent::AUDITOR_PASSWORD_CHANGED, $DTO);
    }

    /**
     * @param AuditorEvent $event
     * @throws \ReflectionException
     */
    public function onAuditorCreated(AuditorEvent $event)
    {
        /** @var AuditorCreateDTO $DTO */
        $DTO = $event->getDTO();

        /** @var User $user */
        $uDTO = new UserCreateDTO($DTO->getUuid(), $DTO->getUsername(), $DTO->getEmail(), $DTO->getPassword(), $DTO->getRoles());
        $user = $this->userManager->createUser($uDTO);
        $event = new UserEvent($uDTO);
        $this->dispatcher->dispatch($event, UserEvent::USER_CREATED);

        /** @var Auditor $auditor */
        $auditor = $this->auditorManager->getFromUuid($DTO->getUuid());
        $auditor->setUser($user);
        $this->auditorManager->save($auditor);

        $this->eventStore->saveEvent(AuditorEvent::AUDITOR_CREATED, $DTO);
    }
}
```

### API Test

Por último tenemos que crear un test que se ejecutan automáticamente en GitLab y si son OK todos es cuando se puede realizar el deploy desde Gitlab también. Un ejemplo 
de clase de test de todas las acciones del auditor: 

```php
<?php

namespace App\Tests\User;

use App\Entity\Auditor;
use App\Entity\Role;
use App\Entity\User;
use App\Tests\api\BaseApiTestBase;
use App\Tests\ApiTester;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;

class AuditorTestCest extends BaseApiTestBase
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

    public function listadoDeAuditores(ApiTester $I)
    {
        $I->wantToTest(Role::ROLE_AUDITOR_ADMIN . ' puede listar los auditores de la empresa');
        $I->amBearerAuthenticated($this->token);
        $I->sendGET('api/auditores');
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->seeResponseIsJson();
        $I->seeResponseJsonMatchesJsonPath('$[0].nombre');
    }

    public function listadoErrorDeAuditores(ApiTester $I)
    {
        $I->wantToTest(Role::ROLE_AUDITOR . ' NO puede listar los auditores de la empresa');
        $this->auth($I, Role::ROLE_AUDITOR);
        $I->amBearerAuthenticated($this->token);
        $I->sendGET('api/auditores');
        $I->seeResponseCodeIs(Response::HTTP_FORBIDDEN);
    }

    public function listadoErrorDeAuditores2(ApiTester $I)
    {
        $I->wantToTest(Role::ROLE_AUDITOR_FREELANCE . ' NO puede listar los auditores de la empresa');
        $this->auth($I, Role::ROLE_AUDITOR_FREELANCE);
        $I->amBearerAuthenticated($this->token);
        $I->sendGET('api/auditores');
        $I->seeResponseCodeIs(Response::HTTP_FORBIDDEN);
    }

    public function getOnePermissions(ApiTester $I)
    {
        $I->wantToTest('Un usuario no puede ver los detalles de un auditor de otra empresa');
        //todo: terminar getOnePermissions test
    }

    public function deletePermissions(ApiTester $I)
    {
        $I->wantToTest('Un usuario no puede borrar un auditor de otra empresa');
        //todo: terminar deletePermissions test
    }

    public function auditorAdminCanCreateAuditores(ApiTester $I)
    {
        $I->wantToTest(Role::ROLE_AUDITOR_ADMIN . ' puede crear auditores');
        $this->auth($I, Role::ROLE_AUDITOR_ADMIN);
        $I->amBearerAuthenticated($this->token);
        $request = [
            'nombre' => 'david',
            'iniciales' => 'DPV',
            'uuid' => Uuid::uuid4(),
            'username' => 'auditor test',
            'email' => 'davidpv@gmail.com',
            'password' => 'simple_password',
            'roles' => [$I->grabFromRepository(Role::class, 'uuid', ['name' => Role::ROLE_AUDITOR])]

        ];

        $I->sendPOST('api/auditores', json_encode($request));
        $I->seeResponseCodeIs(Response::HTTP_CREATED);
    }

    public function auditorChangePasssord(ApiTester $I)
    {
        $I->wantToTest(Role::ROLE_AUDITOR_FREELANCE . ' puede cambiar su password');
        $this->auth($I, Role::ROLE_AUDITOR_FREELANCE);
        $I->amBearerAuthenticated($this->token);

        $users = $I->grabEntitiesFromRepository(User::class, ['roles' => ['name' => Role::ROLE_AUDITOR]]);
        $auditor = $I->grabEntityFromRepository(Auditor::class, ['uuid' => $users[0]->getUuid()]);

        /** @var Auditor $auditor */
        $request = [
            'auditor' => $auditor->getUuid(),
            'password' => 'password_changed'
        ];
        $I->sendPOST('api/auditores/151b2dcb-d089-40d0-b3bc-822ab83fc92b/change-password', json_encode($request));
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->seeResponseIsJson();
        $I->seeResponseJsonMatchesJsonPath('nombre');
    }


}
```









