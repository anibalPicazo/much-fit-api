<?php


namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class BaseFixtures extends Fixture
{
    /** @var Generator */
    protected $faker;
    /**
     * @var UserPasswordEncoderInterface
     */
    protected $encoder;

    /** @var ObjectManager */
    private $manager;

    /**
     * BaseFixtures constructor.
     * @param UserPasswordEncoderInterface $encoder
     * @param EntityManagerInterface $manager
     */
    public function __construct(

        UserPasswordEncoderInterface $encoder,
        EntityManagerInterface $manager

    ) {
        $this->faker = Factory::create('es_ES');
        $this->encoder = $encoder;
        $this->manager = $manager;

    }

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->loadSQL();
    }

    protected function createMany(string $className, int $count, callable $factory)
    {
        for ($i = 0; $i < $count; $i++) {
            $entity = new $className();
            $factory($entity, $i);
            $this->manager->persist($entity);
//             store for usage later as App\Entity\ClassName_#COUNT#
            $this->addReference($className . '_' . $i, $entity);
        }
    }
    /**
    * @throws DBALException
    */
    protected function loadSQL()
    {
        $finder = new Finder();
        $finder->in(__DIR__)->name('*.sql');

        foreach ($finder as $file) {
            $content = $file->getContents();
            $stmt = $this->manager->getConnection()->prepare($content);
            $stmt->execute();
        }
    }
}
