<?php

namespace App\Http\Requests;

use App\Models\Client\Client;
use App\Rules\IsValidDocument;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Client $client)
    {
        return [
			'name' => ['required', 'max:60'],
			'social_name' => ['required', 'max:60'],
			'birthdate' => ['required', 'date'],
			'image' => ['string'],
			'document' => [
				'required',
				Rule::unique(Client::class, 'document')->ignore($this->route('clientId')),
				(new IsValidDocument()),
				'numeric'
			],
        ];
    }
}
