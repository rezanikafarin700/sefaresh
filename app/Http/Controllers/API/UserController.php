<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request)
    {
//        dd(auth()->guard('api')->user());
        $users = User::paginate(4);
//        $users =  User::all();
        return response()->json($users,200);
    }



    public function create()
    {
        //
    }
    public function store(StoreRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'type' => $request->type,
            'city' => $request->city,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'api_token' => $request->api_token
        ]);
        return response($user,201);

    }



    public function show($id)
    {
        try {
            $user =  User::findOrFail($id);
            $data = [
                'id' => $user->id,
                'name' => $user->name,
                'mobile' => $user->mobile,
                'type' => $user->type,
                'city' => $user->city,
                'email' => $user->email,
                'products' => $user->products,
            ];
            return response()->json($data,200);
        }
        catch (\Exception $e){
            return response(['message' => $e->getMessage()],404);
        }
    }


    public function edit($id)
    {
        //
    }
    public function update(UpdateRequest $request, $id)
    {
        $user =  User::findOrFail($id);
        $data = $request->only(['name','city','password']);
        $user->update($data);
        return response($user,202);
    }



    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response(null,204);
    }

}
