<?php

namespace bignumber\factory;

use bignumber\types\BigNumber;
use bignumber\types\IntegerBigNumber;

class IntegerBigNumberFactory extends BigNumberFactory
{
    public function create(string $value): BigNumber
    {
        return new IntegerBigNumber($value);
    }
}