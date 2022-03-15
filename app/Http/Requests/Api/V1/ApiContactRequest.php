<?php

namespace App\Http\Requests\Api\V1;

use App\Models\Contact;
use JetBrains\PhpStorm\Pure;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Foundation\Http\FormRequest;

class ApiContactRequest extends FormRequest
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
     * @return array
     */
    #[ArrayShape([
        'type' => "string[]",
        'contact' => "string[]"
    ])]
    public function rules(): array
    {
        return [
            'type' => [
                'required',
                'string',
                'in:' . collect(Contact::TYPE)->values()->implode(','),
            ],
            'contact' => array_merge([
                'required',
                'string',
                Rule::unique('contacts', 'contact')
                    ->ignore($this->route('contact'))
            ], $this->getContactRules())
        ];
    }

    /**
     * @return array<string, string[]>
     */
    #[Pure]
    private function getContactRules(): array
    {
        if ($this->type == Contact::TYPE['email']) {
            return $this->getContactEmailRules();
        }

        return $this->getContactPhoneRules();
    }

    /**
     * @return array<string, string[]>
     */
    private function getContactEmailRules(): array
    {
        return [
            'email',
            'max:64',
        ];
    }

    /**
     * @return array<string, string[]>
     */
    private function getContactPhoneRules(): array
    {
        return [
            'min:13',
            'max:13',
            'regex:/\+998[0-9]{2}[0-9]{3}[0-9]{2}[0-9]{2}/',
        ];
    }
}
