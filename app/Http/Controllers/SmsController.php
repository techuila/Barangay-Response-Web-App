<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Sms;
use App\Client;
use App\Location;
use App\Http\Resources\Sms as SmsResource;

class SmsController extends Controller
{

    public function index()
    {
        return SmsResource::collection(Sms::paginate(15));
    }


    public function store(Request $request)
    {
        $data = $request->isMethod('put') ? Sms::findOrFail($request->id) : new Sms;

        $data->id = $request->id;
        $data->message = $request->message;
        $data->sim_number = $request->sim_number;
        $data->dt_sent = $request->dt_sent;

        if($data->save()){
            /* Check if sender is registered */
            $client_id = Client::select('id')->where('sim_number','+63'.$data->sim_number)->get(); //Get client_id
            if(count($client_id)){
                $decoded_msg = explode("*",$data->message);
                /* Check if message is valud */
                if(count($decoded_msg) == 3){
                    /* Decode location from message */
                    $loc = explode(',',$decoded_msg[1]);
                    $loc[0] = substr($loc[0],5);
                    $loc[1] = substr($loc[1],5);
                    /* Save location on Location Controller*/
                    $locationController = new LocationController;
                    $req = new Request;
                    $req->setMethod('POST');
                    $req->request->add(['client_id'=> $client_id[0]->id, 'type'=>$decoded_msg[2], 'msg'=>$decoded_msg[0], 'status'=>'Pending', 'long'=>$loc[0], 'lat'=>$loc[1], 'sim_number'=>$data->sim_number]);

                    return $locationController->store($req);
                }else{
                    $send['mmi'][0] = ['msg'=>'The message is not valid! %0APlease use the app to send a report.', 'sim'=>$data->sim_number,'id'=>"1241",'type'=>"Pending"];
                    return $send;
                }
            }else{
                $send['mmi'][0] = ['msg'=>'You are noted on the server. %0ATo register, call or text the following details to 09152401964 %0ALook for _____ %0A%0AName:%0AMobile phone number:%0AAddress:%0ABirthdate:%0A', 'sim'=>$data->sim_number,'id'=>"3214",'type'=>"Pending"];
                return $send;
            }
        }

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
        return new SmsResrouce(Sms::findOrFail($id));
    }
    public function destroy($id)
    {
        $data = Sms::findOrFail($id);

        if($data->delete())
            return new SmsResource($data);

        return false;
    }
}
