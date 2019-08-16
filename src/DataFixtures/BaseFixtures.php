<?php


namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class BaseFixtures extends Fixture
{
    /** @var Generator */
    protected $faker;
    /**
     * @var UserPasswordEncoderInterface
     */
    protected $encoder;
    /**
     * @var SolicitudManager
     */

    /**
     * BaseFixtures constructor.
     * @param UserPasswordEncoderInterface $encoder
     * @param EntityManagerInterface $manager
     * @param SolicitudManager $solicitudManager
     * @param SolicitudAlcanceManager $solicitudAlcanceManager
     * @param SiteManager $siteManager
     */
    public function __construct(UserPasswordEncoderInterface $encoder, EntityManagerInterface $manager)
    {
        $this->faker = Factory::create('es_ES');
        $this->encoder = $encoder;
        $this->manager = $manager;

    }

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
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

}
