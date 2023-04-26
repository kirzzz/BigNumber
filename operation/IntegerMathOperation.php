<?php

namespace bignumber\operation;

use bignumber\types\BigNumber;
use bignumber\types\IntegerBigNumber;

class IntegerMathOperation extends MathOperation
{

    public function add(BigNumber $a, BigNumber $b): BigNumber
    {
        $result = ''; // результирующее число
        $carry = 0; // значение для переноса

        // перебираем числа справа налево
        for ($i = strlen($a) - 1, $j = strlen($b) - 1; $i >= 0 || $j >= 0 || $carry; $i--, $j--) {
            $digit1 = $i >= 0 ? (int)$a->getValue()[$i] : 0; // получаем цифру первого числа
            $digit2 = $j >= 0 ? (int)$b->getValue()[$j] : 0; // получаем цифру второго числа

            // складываем цифры и перенос
            $sum = $digit1 + $digit2 + $carry;

            // если сумма больше 9, вычитаем 10 и запоминаем перенос
            if ($sum > 9) {
                $sum -= 10;
                $carry = 1;
            } else {
                $carry = 0;
            }

            // добавляем результат в начало строки результата
            $result = (string)$sum . $result;
        }

        return new IntegerBigNumber($result);
    }

    public function subtract(BigNumber $a, BigNumber $b): BigNumber
    {
        $result = '';
        $borrow = 0;

        $i = strlen($a) - 1;
        $j = strlen($b) - 1;
        while ($i >= 0 || $j >= 0 || $borrow) {
            $digit = ($j >= 0 ? $a->getValue()[$j] : 0) - ($i >= 0 ? $b->getValue()[$i] : 0) - $borrow;
            if ($digit < 0) {
                $digit += 10;
                $borrow = 1;
            } else {
                $borrow = 0;
            }
            $result .= $result === '0' && $digit === 0 ? '' : $digit;
            $i--;
            $j--;
        }

        return new IntegerBigNumber(strrev($result));
    }

    public function multiplications(BigNumber $a, BigNumber $b): bigNumber {
        $product = $a->isNegative() !== $b->isNegative();
        $a->makePositive();
        $b->makePositive();

        $length1 = strlen($a);
        $length2 = strlen($b);
        $result = new IntegerBigNumber("0");

        for ($i = $length1 - 1; $i >= 0; $i--) {
            $tempResult = "";
            $carry = 0;
            for ($j = $length2 - 1; $j >= 0; $j--) {
                $temp = $a->getValue()[$i] * $b->getValue()[$j] + $carry;
                $carry = (int)($temp / 10);
                $temp %= 10;
                $tempResult = $temp . $tempResult;
            }
            if ($carry > 0) {
                $tempResult = $carry . $tempResult;
            }
            $tempResult .= str_repeat("0", $length1 - $i - 1);
            $result = $this->add($result, new IntegerBigNumber($tempResult));
        }

        if ($product) {
            $result->makeNegative();
        }

        return $result;
    }

    public function divisions(BigNumber $a, BigNumber $b): bigNumber {

        $product = $a->isNegative() !== $b->isNegative();

        if ($b->isZero()) {
            throw new \InvalidArgumentException("Division by zero");
        }

        if ($b->isGreaterThan($a)) {
            return new IntegerBigNumber("0");
        }

        if ($b->isEqual($a)) {
            return new IntegerBigNumber("1");
        }

        $length1 = strlen($a);
        $length2 = strlen($b);
        $quotient = "0";
        $remainder = "0";
        $temp = "";

        for ($i = 0; $i < $length2; $i++) {
            $temp .= $a->getValue()[$i];
        }

        for ($i = $length2; $i <= $length1; $i++) {
            $remainder .= $a->getValue()[$i - 1];
            if ($b->isGreaterThan(new IntegerBigNumber($remainder))) {
                $quotient .= "0";
                continue;
            }

            $count = 0;
            while ($b->isLessThanOrEqual(new IntegerBigNumber($remainder))) {
                $remainder = $this->subtract(new IntegerBigNumber($remainder), $b);
                $count++;
            }
            $quotient .= $count;
        }

        $quotient = new IntegerBigNumber($quotient);
        if ($product) {
            $quotient->makeNegative();
        }

        return $quotient;
    }
}
