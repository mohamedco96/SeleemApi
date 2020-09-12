<?php

namespace App\Http\Controllers\Api\v1;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function auth(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);

        if (!auth()->attempt($loginData)) {
            // register();
            $loginData['password'] = bcrypt($request->password);
            $user = User::create($loginData);
            $accessToken = $user->createToken('authToken')->accessToken;

            return response(['user' => $user, 'access_token' => $accessToken]);
            return response(['message' => 'new user created']);
            // return response(['message' => 'Invalid Credentials']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'access_token' => $accessToken]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'email' => 'required|max:255',
            'password' => 'required|max:255',
            'avatar' => 'max:255',
            'fname' => 'max:255',
            'lname' => 'max:255',
            'age' => 'max:255',
            'gender' => 'max:255',
            'height' => 'max:255',
            'weight' => 'max:255',
            'neck_size' => 'max:255',
            'waist_size' => 'max:255',
            'hips' => 'max:255',
            'goals' => 'max:255',
            'activity' => 'max:255',
            'days_of_training' => 'max:255',
            'training_type' => 'max:255',
            'Water' => 'max:255',
            'online' => 'max:255',

        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $User = User::create($data);

        return response(['user' => new ApiResource($User), 'message' => 'Created User successfully'], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return response(['user' => ApiResource::collection($user), 'message' => 'Retrieved All Users successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response(['user' => new ApiResource($user), 'message' => 'Retrieved User successfully'], 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $user->update($request->all());

        return response(['user' => new ApiResource($user), 'message' => 'Update User successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response(['message' => 'User Deleted successfully']);
    }

}
