<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Services;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return response()->json($clients);
    }

    public function showClient(Request $request)
    {
        $client = Client::find($request->client_id);
        //populate services
        $client->services;
        return response()->json($client, 200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        if (!$request->name || !$request->email) {
            $data = [
                'status' => 'failed',
                'message' => 'Name or email not provided'
            ];
            return response()->json($data, 401);
        }
        //validate


        $client = new Client();
        $client->name = $request->name;
        $client->email = $request->email;
        $client->save();

        return response()->json([
            'status' => "success",
            'message' => 'Client stored sucessfully'
        ],  200);
    }

    public function attachService(Request $request)
    {
        //check if client_id and service_id are provided
        if (!$request->client_id || !$request->service_id) {
            $data = [
                'status' => "failed",
                "message" => 'client_id and service_id are required to attach a service'
            ];
            return response()->json($data, 401);
        }
        //get client 
        $client = Client::find($request->client_id);

        if (!$client) {
            return response()->json([
                'status' => 'failed',
                'message' => 'client not found'
            ], 401);
        }
        //get service 
        $service = Services::where('id', $request->service_id)->get();

        if (!$service) {
            return response()->json([
                'status' => 'failed',
                'message' => 'service not found'
            ], 401);
        }

        //attach service to client
        $client->services()->attach($request->service_id);

        // success 
        $data = [
            'status' => 'success',
            'message' => 'service attached successfully',
            'client' => $client
        ];
        return response()->json($data, 200);
    }
    public function detachService()
    {
    }
}
