<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\IAddressRepository;
use Illuminate\Http\Request;

class AddressController extends Controller
{

    /**
     * @var IAddressRepository
     */
    private $addressRepository;

    public function __construct(IAddressRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $per_page = request('per_page');

        $clients = $this->addressRepository->all(is_null($per_page) ? 10 : $per_page);

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
        $this->addressRepository->create($request->all());
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
        return $this->addressRepository->find($id);
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
        $this->addressRepository->update($request->all(),$id);
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
        $this->addressRepository->delete($id);
        return response()->json(['statusCode' => 200, 'message' =>'resource deleted correctly']);
    }
}
