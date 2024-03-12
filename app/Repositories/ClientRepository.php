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
}