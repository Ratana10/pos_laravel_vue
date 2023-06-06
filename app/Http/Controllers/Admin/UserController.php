<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;

class UserController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $users = User::latest()
        ->paginate(request('perpage') ?? 10, ['*'], 'page', request('page') ?? 1);

        return $this->responseSuccess($users, 'success');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|email',
            'password' => 'nullable|min:4',
            'type' => 'required',
            'status' => 'required',
        ]);
        $user = User::create($validated);
        
        return $this->responseSuccess($user, 'user created successfully');
        
    }


    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|email|unique:users,email,'.$user->id,
            'password' => 'nullable|min:4',
            'type' => 'required',
            'status' => 'required',
        ]);
        
        $user->update($validated);
        $this->responseSuccess([], 'user update successfully');
        
    }


    public function destroy(User $user)
    {
        // return $user;
        try {
            $user->delete();
            return $this->responseSuccess([], 'user delete successfully');
        } catch (\Exception $ex) {
            return $this->responseError([], $ex->getMessage());
        }
        
    }
}