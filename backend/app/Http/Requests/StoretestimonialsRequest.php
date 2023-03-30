<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoretestimonialsRequest extends FormRequest
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
            'avatar' => ['require', 'max:50'],
            'name' => ['require', 'unique:App\Models\testimonials,name','max:50'],
            'text' => ['require', 'max:255'],
            'rating' => ['require']
        ];
    }
}
