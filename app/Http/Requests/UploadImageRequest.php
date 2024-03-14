<?php

namespace App\Http\Requests;

use App\Models\Client\Client;
use App\Rules\IsValidDocument;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class UploadImageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
			'clientImage' => [
				'required',
				File::image()
				->dimensions(
					Rule::dimensions()
						->maxWidth(1090)
						->maxHeight(1090)
				),
			],
        ];
    }
}
