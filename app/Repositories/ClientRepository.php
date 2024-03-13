<?php

namespace App\Repositories;

use App\Dto\ClientDto;
use App\Models\Client\Client;
use Illuminate\Database\Eloquent\Collection;

class ClientRepository
{
	public function listToIndex($searchParam = null)
	{
		$clients = Client::select(
				'id',
				'social_name as socialName',
				'image'
			)
			->when($searchParam, function ($query, $searchParam) {
				return $query->where('social_name', 'LIKE', "%$searchParam%");
			})->paginate(6);

		return $clients;
	}

	public function saveClient($clientData): bool
	{
		if (!$clientData) {
			return false;
		}

		$client = new Client();

		$client->fill($clientData);

		strlen($client->document) > 11
		? $client->setAttribute('type', 'company')
		: $client->setAttribute('type', 'individual');

		return $client->save();
	}
}