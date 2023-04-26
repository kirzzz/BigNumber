<?php

namespace bignumber\definition;

class OperationSpecification implements Specification
{
    public function __construct(public ?string $operation = null)
    {
    }

    public function isSatisfiedBy(string $item): bool
    {
        return $this->operation === trim($item);
    }
}