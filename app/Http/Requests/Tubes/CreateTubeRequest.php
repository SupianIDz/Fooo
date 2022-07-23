<?php

namespace App\Http\Requests\Tubes;

use Illuminate\Foundation\Http\FormRequest;

class CreateTubeRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'detail.name'        => 'required|string|max:255',
            'detail.color'       => 'required|string|max:7',
            'detail.weight'      => 'required|numeric',
            'detail.opacity'     => 'required|numeric|max:1|min:0.1',
            'detail.description' => 'nullable|string',
            'lines'              => 'array',
        ];
    }

    /**
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }
}
