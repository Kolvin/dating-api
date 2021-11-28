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
     * @return ConstraintViolationListInterface<string>
     */
    public function validate(mixed $value): ConstraintViolationListInterface
    {
        return $this->validator->validate($value);
    }

    /**
     * @return array<string>
     */
    public function transformValidationErrors(mixed $request): array
    {
        $violations = $this->validator->validate($request);

        $errors = [];
        foreach ($violations as $violation) {
            $errors[$violation->getPropertyPath()] = $violation->getMessage();
        }

        return $errors;
    }
}
