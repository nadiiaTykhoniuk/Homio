<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Http\Resources\UsersCollection;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\CreateRefugee;
use App\Http\Requests\UpdateRefugee;

class RefugeesController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:api');
    }

    public function index(\Illuminate\Http\Request $request)
    {
//        if (!auth()->user()->hasRole('admin')) {
//            return \Illuminate\Auth\Access\Response::deny('You cannot view refugees', 403);
//        }

        $refugees = User::whereHas('roles', function (Builder $query) {
            $query->where('name', 'refugee');
        })->get();

        return Response::json([
            'data' => new UsersCollection($refugees)
        ], 200);
    }

    public function show(\Illuminate\Http\Request $request, User $refugee)
    {
        if (!auth()->user()->hasRole('admin')) {
            return \Illuminate\Auth\Access\Response::deny('You cannot view this refugee', 403);
        }

        return Response::json([
            'data' => new UserResource($refugee->load(['refugeeRequests']))
        ], 200);
    }

    public function store(CreateRefugee $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            return \Illuminate\Auth\Access\Response::deny('You cannot create refugees', 403);
        }

        $refugeeData = $request->validated();
        $refugee = User::create($refugeeData);

        return Response::json([
            'data' =>  new UserResource($refugee)
        ], 200);
    }

    public function update(UpdateRefugee $request, User $refugee)
    {
        if (!auth()->user()->hasRole('admin')) {
            return \Illuminate\Auth\Access\Response::deny('You cannot update refugees', 403);
        }

        $refugeeData = $request->validated();
        $refugee->update($refugeeData);

        return Response::json([
            'data' => new UserResource($refugee->load(['refugeeRequests']))
        ], 200);
    }

    public function destroy(User $refugee)
    {
        if (!auth()->user()->hasRole('admin')) {
            return \Illuminate\Auth\Access\Response::deny('You cannot destroy refugees', 403);
        }

        $refugee->delete();

        return Response::json([], 204);
    }
}

