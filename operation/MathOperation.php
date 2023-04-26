<?php

namespace bignumber\operation;

use bignumber\types\BigNumber;

abstract class MathOperation
{
    abstract public function add(BigNumber $a, BigNumber $b): BigNumber;

    abstract public function subtract(BigNumber $a, BigNumber $b): BigNumber;

    abstract public function multiplications(BigNumber $a, BigNumber $b): BigNumber;

    abstract public function divisions(BigNumber $a, BigNumber $b): BigNumber;
}