<?php

namespace App\Http\Requests;

use App\Models\Client\Client;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateClientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
			'name' => ['required', 'max:60'],
			'social_name' => ['required', 'max:60'],
			'birth_date' => ['required', 'date'],
			'document' => ['required', Rule::unique(Client::class, 'document'), 'max:14']
        ];
    }
}
