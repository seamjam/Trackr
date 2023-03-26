<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Webshop;
use Illuminate\Support\Facades\Hash;

class WebshopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:superadmin']);
    }

    public function webshopsShow(Request $request)
    {
        $query = User::whereHas('roles', function ($query) {
            $query->where('id', 2);
        })->where('is_admin', true);

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }
//
//        if ($request->has('search')) {
//            $search = $request->input('search');
//            $query->whereRaw("MATCH(name, email) AGAINST(? IN BOOLEAN MODE)", ["*$search*"]);
//        }

        $webshopUsers = $query->with('webshop')->paginate(10);

        return view('superadmin.webshop.show', ['users' => $webshopUsers]);
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
            'postcode' => 'required|string|max:10',
            'house_number' => 'required|string|max:10',
        ]);

        $webshop = new Webshop();
        $webshop->name = $validatedWebshopData['webshop_name'];
        $webshop->postcode = $validatedWebshopData['postcode'];
        $webshop->house_number = $validatedWebshopData['house_number'];
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

        return redirect()->route('webshop.show')->with('success', 'User and Webshop are succesfully created')->with('successDuration', 5);
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
            'postcode' => 'required|string|max:10',
            'house_number' => 'required|string|max:10',
        ]);

        $user = User::findOrFail($id);
        $user->name = $validatedUserData['name'];
        $user->email = $validatedUserData['email'];
        $user->phonenumber = $validatedUserData['phonenumber'];
        $user->save();

        $webshop = Webshop::findOrFail($user->webshop_id);
        $webshop->name = $validatedWebshopData['webshop_name'];
        $webshop->postcode = $validatedWebshopData['postcode'];
        $webshop->house_number = $validatedWebshopData['house_number'];
        $webshop->save();

        return redirect()->route('webshop.show')->with('success', 'User and Webshop are succesfully updated')->with('successDuration', 5);
    }


}
