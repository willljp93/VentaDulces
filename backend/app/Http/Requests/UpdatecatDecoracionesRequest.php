<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatecatDecoracionesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['require', 'unique:App\Models\catDecoraciones,title', 'max:50'],
            'description' => ['require', 'max:255'],
            'image' => ['require', 'max:255'],
            'price' => ['require', 'integer', 'min:1', 'max:99999'],
            'available' => ['require', 'boolean'],
            'rating' => ['require', 'integer', 'min:1', 'max:5'],
            'discount' => 'nullable'
        ];
    }
}
