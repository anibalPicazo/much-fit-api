<?php


namespace App\Service\Forms;


use App\DTO\DTOInterface;
use Doctrine\ORM\EntityManagerInterface;
use ReflectionProperty;
use Symfony\Component\Form\FormInterface;
use function Lambdish\Phunctional\each as each;

class DTOFormFactory
{

    /** @var DTOInterface */
    protected $DTO;

    /** @var FormInterface */
    protected $form;

    /** @var array */
    protected $request;
    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * DTOFormFactory constructor.
     * @param EntityManagerInterface $doctrine
     */
    public function __construct(EntityManagerInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @param DTOInterface $DTO
     * @return DTOFormFactory
     * @throws \ReflectionException
     */
    public function createFromDTO(DTOInterface $DTO)
    {
        $this->DTO = $DTO;
        $this->request = $this->extractData($DTO);
        return $this;
    }

    /**
     * @param DTOInterface $DTO
     * @return array
     * @throws \ReflectionException
     */
    private function extractData(DTOInterface $DTO)
    {
        $reflecion = new \ReflectionClass($DTO);
        $properties = $reflecion->getProperties(ReflectionProperty::IS_PROTECTED);
        $data = [];

        each(function ($property) use (&$data, $DTO) {
            /* @var ReflectionProperty $property * */
            $property->setAccessible(true);
            $value = $property->getValue($DTO);
            if ($value) {
                $data[$property->getName()] = $property->getValue($DTO);
            }
        }, $properties);

        return $data;
    }

    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param FormInterface $form
     * @param $method
     */
    public function submit(FormInterface $form, $method)
    {
        $this->form = $form;
        $clearMissing = $method != 'PATCH';
        $this->form->submit($this->request, $clearMissing);
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return $this->form->isValid();
    }

    /**
     * @return mixed
     */
    public function save()
    {
        $entity = $this->form->getData();
        $this->doctrine->persist($entity);
        $this->doctrine->flush();
        return $entity;
    }

}
