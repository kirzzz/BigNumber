<?php

namespace bignumber\types;

use Stringable;

abstract class BigNumber implements Stringable
{
    public function __construct(protected string $value)
    {
    }

    abstract public function getDelimiter(): string;

    abstract public function makePositive(): void;
    abstract public function makeNegative(): void;

    abstract public function isNegative(): bool;
    abstract public function isZero(): bool;
    abstract public function isGreaterThan(BigNumber $a): bool;
    abstract public function isLessThanOrEqual(BigNumber $a): bool;

    public function isEqual(BigNumber $a): bool
    {
        return $a->getValue() === $this->getValue();
    }

    public function __toString(): string
    {
        return $this->getValue();
    }

    public function getValue(): string
    {
        return $this->value;
    }
}