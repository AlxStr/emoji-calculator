<?php

namespace App\Models;

/**
 * Class Calculator
 *
 * @package App\Models
 */
abstract class Calculator
{
    public abstract function calculate(string $input): string;
}
