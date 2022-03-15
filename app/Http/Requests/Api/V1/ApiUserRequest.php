<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Foundation\Http\FormRequest;

class ApiUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string[]>
     */
    #[ArrayShape([
        'name' => "array"
    ])]
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'min:2',
                'max:64',
                Rule::unique('users', 'name')->ignore($this->id)
            ]
        ];
    }
}
