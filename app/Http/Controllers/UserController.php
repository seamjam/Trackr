<?php

namespace App\Http\Controllers;

use App\Models\Post_company;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function superAdminUsersShow(Request $request)
    {
        $query = User::whereDoesntHave('roles', function ($query) {
            $query->whereIn('id', [1, 2]);
        });

        $users = $this->getPaginatedUsers($request, $query);
        return view('superadmin.user.show', ['users' => $users, 'direction' => $request->input('direction', 'asc')]);
    }

    public function employeesShow(Request $request)
    {
        $query = User::where('webshop_id', auth()->user()->webshop_id)
            ->whereDoesntHave('roles', function ($query) {
                $query->whereIn('id', [1, 2, 6]);
            });

        $users = $this->getPaginatedUsers($request, $query);
        return view('webshop.user.show', ['users' => $users, 'direction' => $request->input('direction', 'asc')]);
    }

    private function getPaginatedUsers(Request $request, $query)
    {
        $search = $request->input('search', '');
        $sort = $request->input('sort', 'name');
        $direction = $request->input('direction', 'asc');

        if ($search) {
            $query->whereRaw("MATCH (name, email) AGAINST (? IN BOOLEAN MODE)", [$search]);
        }
        if (in_array($sort, ['name', 'email', 'phonenumber'])) {
            $query->orderBy($sort, $direction);
        }
        return $query->paginate(10);
    }

    public function create()
    {
        $roles = $this->getRoles();
        return view('webshop.user.create', ['roles' => $roles, 'selectedRoles' => []]);
    }

    private function getRoles()
    {
        return Role::where('name', '!=', 'superadmin')->where('name', '!=', 'webshop')->where('name', '!=', 'courier')->get();
    }

    public function deliveryCompanyUserCreate(Request $request)
    {
        return view('superadmin.delivery_company.create');
    }

    public function deliveryCompanyUserStore(Request $request)
    {
        $validatedUserData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phonenumber' => 'nullable|string|max:20',
        ]);

        $validatePostCompanyData = $request->validate([
            'delivercompany_name' => 'required|string|max:255',
        ]);

        $postCompany = new Post_company();
        $postCompany->name = $validatePostCompanyData['delivercompany_name'];
        $postCompany->save();
        $role = Role::find(6);
        $user = $this->createUser($validatedUserData);
        $user->roles()->attach($role);
        return redirect()->route('superadmin.user.show')->with('success', 'User and delivery company are succesfully created')->with('successDuration', 5);
    }

    private function createUser(array $validatedData, $webshopId = null)
    {
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make('Welkom2023');
        $user->phonenumber = $validatedData['phonenumber'];
        $user->webshop_id = $webshopId;
        $user->is_admin = false;
        $user->save();

        return $user;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate($this->getUserValidationRules());
        $user = $this->createUser($validatedData, auth()->user()->webshop_id);
        $user->roles()->attach($validatedData['roles']);
        return redirect()->route('webshop.user.show')->with('success', 'user is succesfully created')->with('successDuration', 5);
    }

    private function getUserValidationRules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phonenumber' => 'nullable|string|max:20',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ];
    }

    public function edit(User $user)
    {
        $roles = $this->getRoles();
        $selectedRoles = $user->roles->pluck('id')->toArray();
        return view('webshop.user.edit', ['user' => $user, 'roles' => $roles, 'selectedRoles' => $selectedRoles]);
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate(array_merge($this->getUserValidationRules(), [
            'email' => "required|string|email|max:255|unique:users,email,{$user->id}",
        ]));

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->phonenumber = $validatedData['phonenumber'];
        $user->save();
        $user->roles()->sync($validatedData['roles']);
        return redirect()->route('webshop.user.show')->with('success', 'User is successfully updated')->with('successDuration', 5);
    }

    public function destroy($userId)
    {
        User::where('id', $userId)->delete();
        return redirect()->route('webshop.user.show')->with('success', 'The user has been deleted successfully!');
    }
}
