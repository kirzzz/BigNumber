<?php

namespace bignumber\factory;

use bignumber\types\BigNumber;

abstract class BigNumberFactory
{
    abstract public function create(string $value): BigNumber;
}