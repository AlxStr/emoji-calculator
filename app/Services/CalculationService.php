<?php


namespace App\Services;

use App\Contracts\CalculableInterface;
use App\Models\Calculator;

/**
 * Class CalculationService
 *
 * @package App\Services
 */
class CalculationService implements CalculableInterface
{

    private $calculator;


    /**
     * CalculationService constructor.
     *
     * @param Calculator $calculator
     */
    public function __construct(Calculator $calculator)
    {
        $this->calculator = $calculator;
    }

    public function calculate(string $input): string
    {
        return $this->calculator->calculate($input);
    }
}
