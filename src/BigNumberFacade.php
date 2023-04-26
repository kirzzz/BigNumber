<?php

namespace bignumber\src;

use bignumber\definition\NumberSpecification;
use bignumber\definition\OperationSpecification;
use bignumber\operation\MathOperation;
use bignumber\types\BigNumber;
use bignumber\factory\DecimalBigNumberFactory;
use bignumber\factory\IntegerBigNumberFactory;
use bignumber\operation\IntegerMathOperation;

class BigNumberFacade
{
    private int $type;

    private BigNumber $a;
    private BigNumber $b;

    private MathOperation $operation;

    public function __construct(
        string $a,
        string $b
    ) {
        $specification = new NumberSpecification('');
        if (
            $specification->isSatisfiedBy($a)
            && $specification->isSatisfiedBy($b)
        ) {
            $this->a = (new IntegerBigNumberFactory)->create($a);
            $this->b = (new IntegerBigNumberFactory)->create($b);
            $this->operation = new IntegerMathOperation();
            return;
        }

        $specification = new NumberSpecification('.');
        if (
            $specification->isSatisfiedBy($a)
            && $specification->isSatisfiedBy($b)
        ) {
            $this->a = (new DecimalBigNumberFactory)->create($a);
            $this->b = (new DecimalBigNumberFactory)->create($b);
            return;
        }

        throw new \RuntimeException('Нет реализации для взаимодействия разных типов');
    }

    public function operation(string $op): BigNumber
    {
        $specification = new OperationSpecification('+');
        if ($specification->isSatisfiedBy($op)) {
            return $this->operation->add($this->a, $this->b);
        }

        $specification = new OperationSpecification('-');
        if ($specification->isSatisfiedBy($op)) {
            return $this->operation->subtract($this->a, $this->b);
        }

        $specification = new OperationSpecification('/');
        if ($specification->isSatisfiedBy($op)) {
            return $this->operation->divisions($this->a, $this->b);
        }

        $specification = new OperationSpecification('*');
        if ($specification->isSatisfiedBy($op)) {
            return $this->operation->multiplications($this->a, $this->b);
        }

        return $this->a;
    }
}