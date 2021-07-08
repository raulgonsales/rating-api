<?php declare(strict_types=1);

namespace App\Helpers;

use App\Controller\RequestPayload\BaseRequestPayload;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PayloadValidatorHelper
{
    /** @var ValidatorInterface */
    private $validator;
    
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }
    
    /**
     * @param  BaseRequestPayload  $requestPayload
     * @throws PayloadValidatorException
     */
    public function validatePayload(BaseRequestPayload $requestPayload)
    {
        $errors = [];
        /** @var ConstraintViolation $violation */
        foreach ($this->validator->validate($requestPayload) as $violation) {
            $errors[] = $violation->getPropertyPath() . ': ' . $violation->getMessage();
        }
        if (count($errors) > 0) {
            throw new PayloadValidatorException(json_encode($errors));
        }
    }
}
