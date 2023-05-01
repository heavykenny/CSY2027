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
            return redirect()->route('welcome');
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

        return redirect()->route('welcome');
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
                return redirect()->route('admin.home');
            } elseif ($user->role->name === "client") {
                return redirect()->route('admin.home');
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
        return view('client.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);

        $client = Client::create($validatedData);

        return redirect()->route('vendors.show', $client);
    }

    public function show(Client $client)
    {
        $vendors = Vendor::all();
        $roles = Role::all();
        return view('client.show', compact('client', 'roles', 'vendors'));
    }

    public function update(Request $request, Client $client)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);

        $client->update($validatedData);

        return redirect()->route('client.show', $client);
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('client.index');
    }
}
