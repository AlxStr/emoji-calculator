<?php

namespace App\Http\Controllers;

use App\Contracts\CalculableInterface;
use App\Http\Requests\ComputeRequest;

/**
 * Class CalculatorController
 *
 * @package App\Http\Controllers
 */
class CalculatorController extends Controller
{

    private $service;

    /**
     * CalculatorController constructor.
     *
     * @param CalculableInterface $service
     */
    public function __construct(CalculableInterface $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('calculator.index');
    }

    public function compute(ComputeRequest $request)
    {
        $request->get('input');

        $output = $this->service->calculate(
            $request->get('input')
        );

        return view('calculator.index', compact('output'));
    }
}
