<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Location;
use App\Http\Resources\Location as LocationResource;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LocationResource::collection(Location::with('client')->orderBy('created_at','desc')->paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $location = $request->isMethod('put') ? Location::findOrFail($request->id) : new Location;

        $location->id = $request->input('id');
        $location->client_id = $request->input('client_id');
        $location->title = $request->input('type');
        $location->msg = $request->input('msg');
        $location->status = $request->isMethod('put') ? $request->input('status') : "Pending";
        $location->long = $request->input('long');
        $location->lat = $request->input('lat');

        if($location->save()){
            $send['mmi'][0] = ['msg'=>'The message has received by the server %0APlease wait for the response team.', 'sim'=>$request->input('sim_number'),'id'=>strval($location->client_id),'type'=>$location->status];
            return json_encode($send);
        }else{
            $send['mmi'][0] = ['msg'=>"The message was not saved on the server.", 'sim'=>$request->input('sim'),'id'=>strval($location->client_id),'type'=>$location->status];
            return $send;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location = Location::findOrFail($id);

        return new LocationResource($location);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location = Location::findOrFail($id);

        if($location->delete())
            return new LocationResource($location);
    }
}
