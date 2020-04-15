<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ComputeRequest
 *
 * @package App\Http\Requests
 */
class ComputeRequest extends FormRequest
{


    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'input'=> 'required'
        ];
    }
}
