<?php

namespace bignumber\definition;

class NumberSpecification implements Specification
{
    public function __construct(public string $delimiter = '')
    {
    }

    public function isSatisfiedBy(string $item): bool
    {
        return str_contains($item, $this->delimiter);
    }
}