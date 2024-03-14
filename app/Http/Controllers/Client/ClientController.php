<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Requests\UploadImageRequest;
use App\Models\Client\Client;
use App\Repositories\ClientRepository;

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


    public function uploadImage(UploadImageRequest $request)
    {
		if(request()->hasFile('clientImage')) {
			$image = request()->file('clientImage');

			$ext = $image->extension();

			$imgName = md5($image->getClientOriginalName() . strtotime("now")) . ".$ext";

			$image->move(public_path('img/clients'), $imgName);

			return redirect()->back()->with('img_uploaded', $imgName);
		}

		return redirect()->back();
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

		return redirect()->back()->with('fail',	'Nenhum dado para atualizar.');
    }


    public function destroy(string $id)
    {
        $resultMessage = $this->clientRepo->deleteClient($id);

		return to_route('client.index')->with('deleted', $resultMessage);
    }
}
