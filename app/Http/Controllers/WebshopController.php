<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;

class WebshopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:superadmin']);
    }

    public function webshopsShow(Request $request)
    {
        $query = User::where('roles', function ($query) {
            $query->where('id', 2);
        });

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }

        $users = $query->paginate(10);

        return view('superadmin.webshop.show', ['users' => $users]);
    }

    public function create()
    {
        $roles = Role::where('name', '!=', 'superadmin')->get();
        return view('superadmin.webshop.create', ['roles' => $roles, 'selectedRoles' => []]);
    }

}
