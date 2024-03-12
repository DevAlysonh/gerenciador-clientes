<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\ClientRepository;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(ClientRepository $clientRepo)
    {
		$searchParam = null;

		if (request()->input('search')) {
			$searchParam = request()->input('search');
		}

        return inertia('Client/Index', [
			'clients' => $clientRepo->listToIndex($searchParam),
			'searched' => $searchParam ?? ''
		]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
