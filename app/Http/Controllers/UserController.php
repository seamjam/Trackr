<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:superadmin,webshop']);
    }

    public function usersShow(Request $request)
    {
        $query = User::whereDoesntHave('roles', function ($query) {
            $query->whereIn('id', [1, 2]);
        });

        //
//        if ($request->has('search')) {
//            $search = $request->input('search');
//            $query->whereRaw("MATCH(name, email) AGAINST(? IN BOOLEAN MODE)", ["*$search*"]);
//        }

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }

        $users = $query->paginate(10);

        return view('superadmin.user.show.blade.php', ['users' => $users]);
    }

    public function webshopUserShow(Request $request)
    {

        $query = User::where('webshop_id', auth()->user()->webshop_id)
        ->whereDoesntHave('roles', function ($query) {
            $query->whereIn('id', [1, 2]);
        });

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }

        $users = $query->paginate(10);

        return view('webshop.user.show.blade.php', ['users' => $users]);
    }

    public function create()
    {
        $roles = Role::where('name', '!=', 'superadmin')->where('name', '!=', 'webshop')->get();
        return view('webshop.user.create', ['roles' => $roles, 'selectedRoles' => []]);
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
        $user->webshop_id = auth()->user()->webshop_id;
        $user->is_admin = false;
        $user->save();

        $user->roles()->attach($validatedData['roles']);

        return redirect()->route('webshop.user.show.blade.php')->with('success', 'user is succesfully created')->with('successDuration', 5);
    }

    public function edit(User $user)
    {
        $roles = Role::where('name', '!=', 'superadmin')->where('name', '!=', 'webshop')->get();
        $selectedRoles = $user->roles->pluck('id')->toArray();
        return view('webshop.user.edit', ['user' => $user, 'roles' => $roles, 'selectedRoles' => $selectedRoles]);
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|string|email|max:255|unique:users,email,{$user->id}",
            'phonenumber' => 'nullable|string|max:20',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->phonenumber = $validatedData['phonenumber'];
        $user->save();

        $user->roles()->sync($validatedData['roles']);

        return redirect()->route('webshop.user.show.blade.php')->with('success', 'User is successfully updated')->with('successDuration', 5);
    }

    public function destroy($userId)
    {
        User::where('id', $userId)->delete();
        return redirect()->route('webshop.user.show.blade.php')->with('success', 'The user has been deleted successfully!');
    }

}
