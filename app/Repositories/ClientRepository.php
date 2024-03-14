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
		$client->defineType();

		return $client->save();
	}

	public function updateClient(Client $client, array $updateData): bool
	{
		$client->update($updateData);
		$client->defineType();

		return $client->save();
	}

	public function deleteClient(int $id): string
	{
		$client = Client::find($id);
		$clientName = $client->social_name;

		$client->delete();

		return "O perfil de $clientName foi deletado permanentemente.";
	}

	public function findOne(int $id): Client
	{
		return Client::findOrFail($id);
	}
}