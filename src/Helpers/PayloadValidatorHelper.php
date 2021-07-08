<?php declare(strict_types=1);

namespace App\Helpers;

use App\Controller\RequestPayload\BaseRequestPayload;
use Symfony\Component\Validator\ConstraintViolation;
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
    public function validatePayload(BaseRequestPayload $requestPayload): void
    {
        $errors = [];
        /** @var ConstraintViolation $violation */
        foreach ($this->validator->validate($requestPayload) as $violation) {
            $errors[] = $violation->getPropertyPath() . ': ' . $violation->getMessage();
        }
        if (count($errors) > 0) {
            $encodedErrors = json_encode($errors);
            if ($encodedErrors === false) {
                $encodedErrors = 'Unknown error happened.';
            }
            throw new PayloadValidatorException($encodedErrors);
        }
    }
}
