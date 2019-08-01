<?php


namespace App\Validator;


use App\Serializer\ApiRestErrorNormalizer;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DTOValidator
 * @package App\Service\Core
 */
class DTOValidator
{
    /** @var \App\Serializer\ApiRestErrorNormalizer */
    private $errorNormalizer;

    const  VALIDATION_REQUEST_PARAMETER = "validation_errors";

    /**
     * DTOValidator constructor.
     * @param \App\Serializer\ApiRestErrorNormalizer $errorNormalizer
     */
    public function __construct(ApiRestErrorNormalizer $errorNormalizer)
    {
        $this->errorNormalizer = $errorNormalizer;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return array|bool|float|int|string|void
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public function validate(Request $request)
    {
        /** @var \Symfony\Component\Validator\ConstraintViolationListInterface $parameterBagErrors */
        $parameterBagErrors = $request->attributes->get(self::VALIDATION_REQUEST_PARAMETER);
        if ($parameterBagErrors->count() > 0) {
            return $this->errorNormalizer->normalize($parameterBagErrors);
        }

        return;
    }


}
