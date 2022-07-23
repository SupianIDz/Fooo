<?php

namespace App\Http\Requests\Markers;

use Illuminate\Foundation\Http\FormRequest;

class CreateMarkerRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules() : array
    {
        return [
            'name'    => 'required|string|max:255',
            'lat'     => 'required|numeric',
            'lng'     => 'required|numeric',
            'address' => 'required|string',
            'type'    => 'required|string',
            'portal'  => 'integer',
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
