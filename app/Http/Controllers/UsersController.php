<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\User;
use Inertia\Inertia;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Users/Index', [
            'filters' => $request->input('search'),
            'users' => User::where('id', '!=', Auth::id())
                ->filter($request->input('search'))
                ->select('id', 'name', 'email')
                ->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Users/Create');
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:50'], 
            'email' => ['required', 'string', 'email', 'max:50', Rule::unique('users')],
        ])->validateWithBag('CreateUser');

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make(Str::random(8))
        ]);

        return redirect()->route('users')->with('success', 'User created.');
    }

    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ],
        ]);
    }

    public function update(Request $request, User $user)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:50', Rule::unique('users')->ignore($user->id)],
        ])->validateWithBag('UpdateUser');

        $user->forceFill([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ])->save();

        return redirect()->back()->with('success', 'User updated.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users')->with('success', 'User deleted.');
    }
}
