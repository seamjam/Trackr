<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Webshop;
use Illuminate\Support\Facades\Hash;

class WebshopController extends Controller
{
    public function webshopsShow(Request $request)
    {
        $sort = $request->get('sort', 'webshop_name');
        $direction = $request->get('direction', 'asc');
        $nextDirection = $direction === 'asc' ? 'desc' : 'asc';
        $search = $request->get('search', '');

        $query = User::whereHas('roles', function ($query) {
            $query->where('id', 2);
        })->where('is_admin', true);

        if (!empty($search)) {
            $searchTerms = explode(' ', $search);
            $searchSql = implode('* ', $searchTerms) . '*';

            $query->where(function ($query) use ($searchSql) {
                $query->whereRaw("MATCH (name, email) AGAINST (? IN BOOLEAN MODE)", $searchSql)
                    ->orWhereHas('webshop', function ($query) use ($searchSql) {
                        $query->whereRaw("MATCH (name) AGAINST (? IN BOOLEAN MODE)", $searchSql);
                    });
            });
        }
        switch ($sort) {
            case 'webshop_name':
                $query->with(['webshop' => function ($query) use ($direction) {
                    $query->orderBy('name', $direction);
                }]);
                break;
            case 'owner_name':
                $query->orderBy('name', $direction);
                break;
            case 'email':
                $query->orderBy('email', $direction);
                break;
            case 'phone_number':
                $query->orderBy('phonenumber', $direction);
                break;
        }
        $webshopUsers = $query->paginate(10);

        return view('superadmin.webshop.show', ['users' => $webshopUsers, 'direction' => $nextDirection]);
    }

    public function create()
    {
        $roles = Role::where('name', '!=', 'superadmin')->get();
        return view('superadmin.webshop.create', ['roles' => $roles, 'selectedRoles' => []]);
    }

    public function edit(User $user)
    {
        return view('superadmin.webshop.edit', ['user' => $user]);
    }

    public function store(Request $request)
    {
        $validatedUserData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phonenumber' => 'nullable|string|max:20',
        ]);

        $validatedWebshopData = $request->validate([
            'webshop_name' => 'required|string|max:255',
        ]);

        $webshop = new Webshop();
        $webshop->name = $validatedWebshopData['webshop_name'];
        $webshop->save();

        $role = Role::find(2);

        $user = new User();
        $user->name = $validatedUserData['name'];
        $user->email = $validatedUserData['email'];
        $user->password = Hash::make('Welkom2023');
        $user->phonenumber = $validatedUserData['phonenumber'];
        $user->is_admin = true;
        $user->webshop_id = $webshop->id;
        $user->save();
        $user->roles()->attach($role);

        return redirect()->route('superadmin.webshop.show')->with('success', 'User and Webshop are succesfully created')->with('successDuration', 5);
    }

    public function update(Request $request, $id)
    {
        $validatedUserData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phonenumber' => 'nullable|string|max:20',
        ]);

        $validatedWebshopData = $request->validate([
            'webshop_name' => 'required|string|max:255',
        ]);

        $user = User::findOrFail($id);
        $user->name = $validatedUserData['name'];
        $user->email = $validatedUserData['email'];
        $user->phonenumber = $validatedUserData['phonenumber'];
        $user->save();

        $webshop = Webshop::findOrFail($user->webshop_id);
        $webshop->name = $validatedWebshopData['webshop_name'];
        $webshop->save();

        return redirect()->route('superadmin.webshop.show')->with('success', 'User and Webshop are succesfully updated')->with('successDuration', 5);
    }


}
