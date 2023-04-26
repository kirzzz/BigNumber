<?php

namespace bignumber\types;

class IntegerBigNumber extends BigNumber
{
    public function isGreaterThan(IntegerBigNumber|BigNumber $a): bool
    {
        $len1 = strlen($this);
        $len2 = strlen($a);

        // Если длина чисел различается, то число с большей длиной является большим
        if ($len1 != $len2) {
            return ($len1 > $len2);
        }

        // Иначе сравниваем цифру за цифрой, начиная с младших разрядов
        for ($i = $len1 - 1; $i >= 0; $i--) {
            if ($this->getValue()[$i] != $a->value[$i]) {
                return ($this->getValue()[$i] > $a->value[$i]);
            }
        }

        // Если все цифры равны, то числа равны
        return false;
    }

    public function isLessThanOrEqual(IntegerBigNumber|BigNumber $a): bool
    {
        return !$this->isGreaterThan($a);
    }

    public function getDelimiter(): string
    {
        return '';
    }

    public function makePositive(): void
    {
        if ($this->isNegative()) {
            $this->value = substr($this->value, 1, strlen($this->value));
        }
    }

    public function makeNegative(): void
    {
        if (!$this->isNegative()) {
            $this->value = '-' . $this->value;
        }
    }

    public function isNegative(): bool
    {
        return strlen($this->value) > 0 && $this->value[0] === '-';
    }

    public function isZero(): bool
    {
        return $this->value === '0';
    }
}