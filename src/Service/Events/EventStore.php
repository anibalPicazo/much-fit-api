<?php


namespace App\Service\Events;


use App\DTO\DTOInterface;
use App\Entity\Event;
use App\Entity\User;
use App\Service\DTO\DTOExtractor;
use App\Service\Storage\StorageManagerInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use ReflectionException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class EventStore
{
    /**
     * @var DTOExtractor
     */
    protected $extractor;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var SerializerInterface
     */
    private $serializer;
    /**
     * @var StorageManagerInterface
     */
    private $storageManager;

    /**
     * EventStore constructor.
     * @param StorageManagerInterface $storageManager
     * @param TokenStorageInterface $tokenStorage
     * @param SerializerInterface $serializer
     * @param DTOExtractor $extractor
     */
    public function __construct(
        StorageManagerInterface $storageManager,
        TokenStorageInterface $tokenStorage,
        SerializerInterface $serializer,
        DTOExtractor $extractor
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->serializer = $serializer;
        $this->storageManager = $storageManager;
        $this->extractor = $extractor;
    }

    /**
     * @param string $name
     * @param DTOInterface $payload
     * @throws ReflectionException
     */
    public function saveEvent(string $name, DTOInterface $payload)
    {
        //todo: realizar test api para comprobar que se serializa correctamente.
        if ($this->tokenStorage->getToken()) {  //is used in tests you dont have the logged user.
            /** @var User $user */
            $user = $this->tokenStorage->getToken()->getUser();
            $event = new Event();
            $event->setName($name);
            $event->setPayload($this->serialize($payload));
            $event->setUser($user);

            $this->storageManager->save($event);
        }
    }

    /**
     * @param DTOInterface $DTO
     * @return array
     * @throws ReflectionException
     */
    private function serialize(DTOInterface $DTO): array
    {
        $results = [];
        $data = $this->extractor->extractData($DTO);
        foreach ($data as $key => $node) {
            $groups = SerializationContext::create()->setGroups(['list', 'event']);
            $data = $this->serializer->serialize($node, 'json', $groups);
            $results[$key] = @json_decode($data, true);
        }
        return $results;
    }
}

