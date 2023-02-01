<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
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
            'name'      => 'required',
            'type'      => 'required|in:Planet,Cluster,Dream,Fantasy town,Space station,Microverse,TV,Resort,unknown',
            'dimension' => 'required|in:Dimension C-137,Dimension 5-126,Fantasy Dimension,Cronenberg Dimension,Replacement Dimension,unknown',
        ];
    }
}
