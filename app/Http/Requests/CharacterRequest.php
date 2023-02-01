<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CharacterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required',
            'origin'        => 'required|integer',
            'type'          => 'required',
            'status'        => 'required|in:Alive,Dead,unknown',
            'species'       => 'required|in:Human,Alien,unknown',
            'gender'        => 'required|in:Male,Female,unknown',
            'image'         => 'mimes:png,jpg,jpeg',
        ];
    }
}
