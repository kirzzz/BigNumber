<?php

namespace bignumber\factory;

use bignumber\types\BigNumber;
use bignumber\types\DecimalBigNumber;

class DecimalBigNumberFactory extends BigNumberFactory
{
    public function create(string $value): BigNumber
    {
        return new DecimalBigNumber($value);
    }
}