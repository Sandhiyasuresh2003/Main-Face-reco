<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function showRegistrationForm()
    {
        return view('registration');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        }

        return back()->withErrors(['username' => 'Invalid credentials.']);
    }

    public function register(Request $request) {
        $validated = $request->validate([
            'name' => ['required','string','max:100'],
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'class' => 'sometimes',
            'reg_no' => 'sometimes',
            'phone_number' => 'sometimes',
        ]);
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validated['profile_picture'] = $path;
        }

        $user = $this->create($validated);
        Auth::login($user);

        return redirect()->route('home')->with('success', 'You have signed-in');
    }
    public function create(array $data) {
        return User::create([
            'username' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'profile_picture' => $data['profile_picture'] ?? null,
            'phone_number' => $data['phone_number'],
            'class' => $data['class'],
            'reg_no' => $data['reg_no'],
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.form');
    }
}
