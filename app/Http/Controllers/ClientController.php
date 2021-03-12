<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Client;
use App\Http\Resources\Client as ClientResource;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ClientResource(Client::all());
    }

    public function store(Request $request)
    {
        $data = ($request->isMethod('put'))? Client::findOrFail($request->id) : new Client ;

        $data->id = $request->input('id');
        $data->name = $request->input('name');
        $data->address = $request->input('address');
        $data->birthdate = $request->input('birthdate');
        $data->sim_number = $request->input('sim_number');

        if($data->save())
            return new ClientResource($data);

        return false;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ClientResource(Client::findOrFail($id));
    }

    public function destroy($id)
    {
        $data = Client::findOrFail($id);

        if($data->delete())
            return new ClientResource($data);
            
        return false;
    }
}
