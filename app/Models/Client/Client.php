<?php

namespace App\Models\Client;

use App\Enums\ClientType;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
	protected $table = 'clients';
	protected $fillable = [
		'name',
		'type',
		'image',
		'document',
		'birthdate',
		'social_name',
	];

	public function typeToShow(): string
	{
		return $this->type == 'individual'
				? 'Pessoa Física'
				: 'Pessoa Jurídica';
	}

	public function defineType(): void
	{
		strlen($this->document) > 11
		? $this->setAttribute('type', 'company')
		: $this->setAttribute('type', 'individual');
	}
}
