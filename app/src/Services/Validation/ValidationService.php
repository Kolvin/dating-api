<?php

namespace App\Services\Validation;

use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValidationService
{
    public function __construct(private ValidatorInterface $validator)
    {
    }

    /**
     * @param mixed $value
     *
     * @return ConstraintViolationListInterface<int, string>
     */
    public function validate($value): ConstraintViolationListInterface
    {
        return $this->validator->validate($value);
    }

    /**
     * @param mixed $request
     *
     * @return array<string>
     */
    public function transformValidationErrors($request)
    {
        $violations = $this->validator->validate($request);

        $errors = [];
        foreach ($violations as $violation) {
            $errors[$violation->getPropertyPath()] = $violation->getMessage();
        }

        return $errors;
    }
}
