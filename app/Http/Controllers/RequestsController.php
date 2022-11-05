<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequest;
use App\Http\Resources\RequestResource;
use App\Http\Resources\RequestsCollection;
use App\Models\Request;
use Illuminate\Support\Facades\Response;

class RequestsController extends Controller
{/**
 * Create a new AuthController instance.
 *
 * @return void
 */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(\Illuminate\Http\Request $request)
    {
        return Response::json([
            'data' => new RequestsCollection(Request::with(['worker', 'refugee'])->get())
        ], 200);
    }

    public function show(\Illuminate\Http\Request $httpRequest, \App\Models\Request $request)
    {
        return Response::json([
            'data' => new RequestResource($request->load(['worker', 'refugee']))
        ], 200);
    }

    public function store(CreateRequest $request)
    {
        $requestData = $request->validated();
        $requestData['worker_id'] = auth()->user()->hasRole('admin') ? auth()->user()->id : $requestData['worker_id'];
        $requestData['refugee_id'] = auth()->user()->hasRole('refugee') ? auth()->user()->id : $requestData['refugee_id'];

        $request = Request::create($requestData);

        return Response::json([
            'data' => new RequestResource($request->load(['worker', 'refugee']))
        ], 200);
    }
}

