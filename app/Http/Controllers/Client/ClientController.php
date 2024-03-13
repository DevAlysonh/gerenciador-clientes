<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateClientRequest;
use App\Repositories\ClientRepository;
use Illuminate\Http\Request;

class ClientController extends Controller
{
	public function __construct(
		protected ClientRepository $clientRepo
	) {	}

    public function index()
    {
		$searchParam = null;

		if (request()->input('search')) {
			$searchParam = request()->input('search');
		}

        return inertia('Client/Index', [
			'clients' => $this->clientRepo->listToIndex($searchParam),
			'searched' => $searchParam ?? ''
		]);
    }


    public function create()
    {
        return inertia('Client/Create');
    }


    public function store(CreateClientRequest $request)
    {
		$data = request()->all();

		if($this->clientRepo->saveClient($data)) {
			return redirect()->back()->with('success', 'Cliente cadastrado!');
		}

		return redirect()->back()->with('fail', 'Ocorreu um erro ao salvar o cliente.');
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
