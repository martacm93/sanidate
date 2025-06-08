<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class Users extends Controller
{

  public function index(Request $request)
  {
    $auth_user = User::find(auth()->user()->id);
    $search = $request->input('search');
    $role = $request->input('role');

    if ($auth_user->hasRole('admin')) {
      $users = User::when($search, function ($query, $search) {
        return $query->where(function ($q) use ($search) {
          $q->where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%");
        });
      })
        ->when($role, function ($query, $role) {
          return $query->whereHas('roles', function ($q) use ($role) {
            $q->where('name', $role);
          });
        })
        ->paginate(10)
        ->appends(['search' => $search, 'role' => $role]);
    } else {
      $users = User::where('id', $auth_user->id)->paginate(10);
    }

    return view('content.pages.users.home', ['users' => $users]);
  }

  public function create()
  {
    return view('content.pages.users.create');
  }

  public function store(StoreUser $request)
  {
    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->save();
    $user->assignRole('admin');

    return redirect()->route('pages-users');
  }

  public function show($user_id)
  {
    $user = User::find($user_id);
    return view('content.pages.users.show', ['user' => $user]);
  }

  public function edit($user_id)
  {
    $user = User::find($user_id);
    return view('content.pages.users.edit', ['user' => $user]);
  }

  public function update(UpdateUser $request)
  {
    $user = User::find($request->user_id);
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->new_password);
    $user->save();
    return redirect()->route('pages-users');
  }

  public function delete($user_id)
  {
    $user = User::find($user_id);
    return view('content.pages.users.delete', ['user' => $user]);
  }

  public function destroy(Request $request)
  {
    $user = User::find($request->user_id);
    $user->delete();
    return redirect()->route('pages-users');
  }
}
