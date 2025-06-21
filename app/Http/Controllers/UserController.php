<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('permissions')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('users.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|min:6',
            'permissions' => 'array|required',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->givePermissionTo($request->permissions);

        return redirect()->route('users.index')->with('success', 'تم إنشاء المستخدم بنجاح مع صلاحياته');
    }
}
