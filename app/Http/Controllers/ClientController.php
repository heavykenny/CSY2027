<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Role;
use App\Models\Vendor;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function showLoginForm(): Factory|View|Application
    {
        return view('admin.login');
    }

    public function logout(Request $request): Redirector|Application|RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showRegistrationForm(): Application|Factory|View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('welcome')->with('success', 'You are already logged in.');
        }

        return view('admin.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $client = new Client();
        $client->name = $request->input('name');
        $client->email = $request->input('email');
        $client->password = Hash::make($request->input('password'));
        $client->role_id = Role::where(["name" => "client"])->first()->id;
        $client->save();

        Auth::login($client);

        return redirect()->route('welcome')->with('success', 'Registration successful.');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role->name === "admin") {
                return redirect()->route('admin.home')->with('success', 'Login successful as Admin.');
            } elseif ($user->role->name === "client") {
                return redirect()->route('admin.home')->with('success', 'Login successful as Client.');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    public function index()
    {
        $clients = Client::all();

        return view('client.index', compact('clients'));
    }

    public function create()
    {
        $roles = Role::all();
        $vendors = Vendor::all();
        return view('client.create', compact('roles', 'vendors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'role_id' => 'nullable|integer|exists:roles,id',
            'vendor_id' => 'nullable|integer|exists:vendors,id',
        ]);

        $client = new Client();
        $client->name = $request->input('name');
        $client->email = $request->input('email');
        $client->password = Hash::make($request->input('password'));
        $client->role_id = $request->input('role_id') ?? Role::where(["name" => "client"])->first()->id;
        $client->vendor_id = $request->input('vendor_id');
        $client->save();

        return redirect()->route('vendor.index')->with('success', 'Client created successfully.');
    }

    public function show(Client $client)
    {
        $vendors = Vendor::all();
        $roles = Role::all();
        return view('client.show', compact('client', 'roles', 'vendors'));
    }

    public function update(Request $request, Client $client): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|string|min:8',
            'role_id' => 'nullable|integer|exists:roles,id',
            'vendor_id' => 'nullable|integer|exists:vendors,id',
        ]);

        $validatedData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password') ? Hash::make($request->input('password')) : $client->password,
            'role_id' => $request->input('role_id') ?? Role::where(["name" => "client"])->first()->id,
            'vendor_id' => $request->input('vendor_id'),
        ];

        $client->update($validatedData);

        return redirect()->route('client.show', $client)->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('client.index')->with('success', 'Client deleted successfully.');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('user_profile', compact('user'));
    }
}
