<?php

namespace App\Http\Controllers\Client;

use App\Enums\ClientType;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateClientRequest;
use App\Http\Requests\UpdateClientRequest;
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
        $client = $this->clientRepo->findOne($id);

		if($client) {
			return inertia('Client/Show', [
				'client' => $client,
				'clientType' => $client->typeToShow()
			]);
		}

		return redirect()
			->route('client.index')
			->with(
				'no_content',
				'O cliente que você está procurando não existe, ou foi deletado.'
			);
    }


    public function edit(string $id)
    {
        //
    }


    public function update(UpdateClientRequest $request, string $id)
    {
		$updatedData = request()->all();
		$client = $this->clientRepo->findOne($id);

		if($this->clientRepo->updateClient($client, $updatedData)) {
			return redirect()->back()->with('success', 'Os dados do cliente foram atualizados.');
		}

		return redirect()->back()->with('fail',	'Não foi possível atualizar os dados do cliente.');
    }


    public function destroy(string $id)
    {
        //
    }
}
