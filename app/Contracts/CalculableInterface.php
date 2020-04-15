<?php


namespace App\Contracts;


/**
 * Interface CalculableInterface
 *
 * @package App\Contracts
 */
interface CalculableInterface
{

    /**
     * @param string $input
     *
     * @return string
     */
    public function calculate(string $input);
}
