<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.users', compact('users'));
    }

    public function makeAdmin($id)
    {
        $user = User::find($id);
        $user->update([
            'role' => 'Admin',
        ]);
        return redirect('/users');
    }

    public function makeUser($id)
    {
        if ($id == 1) {
            return redirect('/users')->with('msg', 'You can not make the Super Admin a user');
        }
        $user = User::find($id);
        $user->update([
            'role' => 'user',
        ]);
        return redirect('/users');
    }

    public function destroy(Request $request)
    {
        if ($request->id == 1) {
            return redirect('/users')->with('msg', 'You cant delete the Super Admin');
        } else if ($request->id != 1) {
            $user = User::find($request->id);
            $user->delete();
            return redirect('/users')->with('msg', 'User Deleted Successfully');
        }
    }
}
