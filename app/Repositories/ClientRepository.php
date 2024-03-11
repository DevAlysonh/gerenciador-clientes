<?php

namespace App\Repositories;

use App\Models\Client\Client;

class ClientRepository
{
	public function listAll()
	{
		return Client::all();
	}
}