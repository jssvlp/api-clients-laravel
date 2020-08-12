<?php

namespace App\Http\Controllers;

use App\Client;
use App\Repositories\ClientRepository;
use App\Repositories\Interfaces\IProfileRepository;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    /**
     * @var IProfileRepository
     */
    private $profileRepository;

    public function __construct(IProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $per_page = request('per_page');

        $clients = $this->profileRepository->all(is_null($per_page) ? 10 : $per_page);

        return response()->json($clients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $client_id = $request->client_id;
        $clientRepository = new ClientRepository(new Client());
        $client = $clientRepository->search($client_id);

        if(!$client){
            return response()->json(['statusCode' => 404, 'message' => 'client not found']);
        }
        $profile =  $this->profileRepository->create($request->except('client_id'));

        $client->profile_id = $profile->id;

        $client->save();

        return response()->json(['statusCode' => 201, 'message' =>'resource created correctly']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->profileRepository->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $this->profileRepository->update($id,$request->all());
        return response()->json(['statusCode' => 200, 'message' =>'resource updated correctly']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->profileRepository->delete($id);
        return response()->json(['statusCode' => 200, 'message' =>'resource deleted correctly']);

    }
}
