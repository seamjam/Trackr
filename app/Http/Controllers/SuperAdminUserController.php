<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SuperAdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:superadmin');
    }

    public function index()
    {
        return view('superadmin.user.index');
    }

    public function usersShow()
    {
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('id', 1);
        })->get();
        return view('superadmin.user.users_show', ['users' => $users]);
    }

    public function create()
    {
        $roles = Role::where('name', '!=', 'superadmin')->get();
        return view('superadmin.user.create_user', ['roles' => $roles, 'selectedRoles' => []]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phonenumber' => 'nullable|string|max:20',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make('Welkom2023');
        $user->phonenumber = $validatedData['phonenumber'];
        $user->save();

        $user->roles()->attach($validatedData['roles']);

        return redirect()->route('superadmin.users_show')->with('success', 'User is succesfully created')->with('successDuration', 5);
    }

    public function usersDestroy(Request $request)
    {
        $userIds = $request->input('users');
        User::whereIn('id', $userIds)->delete();

        return redirect()->route('superadmin.users_show')->with('success', 'Selected users have been deleted successfully!');
    }
}
