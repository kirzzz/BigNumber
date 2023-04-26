<?php

namespace bignumber\definition;

interface Specification
{
    public function isSatisfiedBy(string $item): bool;
}