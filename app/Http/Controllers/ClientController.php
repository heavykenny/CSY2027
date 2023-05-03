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

/**
 * This class handles all the client related functions
 *
 */
class ClientController extends Controller
{
    /**
     * This function shows the login form
     * @return Factory|View|Application
     */
    public function showLoginForm(): Factory|View|Application
    {
        return view('admin.login');
    }

    /**
     * This logs out the user
     * it invalidates the session and invalidates the token
     *
     * @param Request $request
     * @return Redirector|Application|RedirectResponse
     */
    public function logout(Request $request): Redirector|Application|RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * This function shows the registration form
     * @return Application|Factory|View|RedirectResponse
     */
    public function showRegistrationForm(): Application|Factory|View|RedirectResponse
    {
        // if the user is already logged in, redirect them to the welcome page
        if (Auth::check()) {
            return redirect()->route('welcome')->with('success', 'You are already logged in.');
        }

        return view('admin.register');
    }

    /**
     * This function registers a new client
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function register(Request $request): RedirectResponse
    {
        // validate the request data
        // it validates the email to be unique in the clients table
        // it also validates the password to be at least 8 characters long
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // create a new client
        $client = new Client();
        $client->name = $request->input('name');
        $client->email = $request->input('email');

        // hash the password for security
        $client->password = Hash::make($request->input('password'));
        $client->role_id = Role::where(["name" => "client"])->first()->id;
        $client->save();

        // log the client in
        Auth::login($client);

        return redirect()->route('welcome')->with('success', 'Registration successful.');
    }

    /**
     * This function logs in a client
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        // validate the request data
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        // attempt to log the client in
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // redirect the client to the appropriate page based on their role
            if ($user->role->name === "admin") {
                return redirect()->route('admin.home')->with('success', 'Login successful as Admin.');
            } elseif ($user->role->name === "client") {
                return redirect()->route('welcome')->with('success', 'Login successful as Client.');
            }
        }

        // if the login attempt fails, redirect the client back to the login page with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    /**
     * get all the clients
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $clients = Client::all();

        return view('client.index', compact('clients'));
    }

    /**
     * This function shows the create client form
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $roles = Role::all();
        $vendors = Vendor::all();
        return view('client.create', compact('roles', 'vendors'));
    }

    /**
     *  this function stores a new client
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // validate the request data
        // it validates the email to be unique in the clients table
        // it also validates the password to be at least 8 characters long
        // it also validates the role_id to be a valid role
        // it also validates the vendor_id to be a valid vendor
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'role_id' => 'nullable|integer|exists:roles,id',
            'vendor_id' => 'nullable|integer|exists:vendors,id',
        ]);
        // create a new client
        $client = new Client();
        $client->name = $request->input('name');
        $client->email = $request->input('email');

        // hash the password for security
        $client->password = Hash::make($request->input('password'));
        $client->role_id = $request->input('role_id') ?? Role::where(["name" => "client"])->first()->id;
        $client->vendor_id = $request->input('vendor_id');
        $client->save();

        return redirect()->route('vendor.index')->with('success', 'Client created successfully.');
    }

    /**
     * this function shows the edit client form
     * @param Client $client
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function show(Client $client)
    {
        $vendors = Vendor::all();
        $roles = Role::all();
        return view('client.show', compact('client', 'roles', 'vendors'));
    }

    /**
     *  this function delete the client
     * @param Client $client
     * @return RedirectResponse
     */
    public function destroy(Client $client): RedirectResponse
    {
        $client->delete();

        return redirect()->route('client.index')->with('success', 'Client deleted successfully.');
    }

    /**
     * this function update the client
     * @return Application|Factory|View
     */
    public function profile(): View|Factory|Application
    {
        $user = Auth::user();
        return view('user_profile', compact('user'));
    }

    /**
     * this function update the client profile form
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateProfile(Request $request): RedirectResponse
    {
        $user = Auth::user();

        // validate the request data
        $request->validate([
            'name' => 'required|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'postcode' => 'nullable|string',
            'country' => 'nullable|string',
        ]);

        // update the user
        $user->update([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'postcode' => $request->input('postcode'),
            'country' => $request->input('country'),
        ]);

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully.');
    }

    /**
     * this function updates a client
     * @param Request $request
     * @param Client $client
     * @return RedirectResponse
     */
    public function update(Request $request, Client $client): RedirectResponse
    {
        // validate the request data
        // it validates the email to be unique in the clients table
        // it also validates the password to be at least 8 characters long
        // it also validates the role_id to be a valid role
        // it also validates the vendor_id to be a valid vendor
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|string|min:8',
            'role_id' => 'nullable|integer|exists:roles,id',
            'vendor_id' => 'nullable|integer|exists:vendors,id',
        ]);


        $client->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password') ? Hash::make($request->input('password')) : $client->password,
            'role_id' => $request->input('role_id') ?? Role::where(["name" => "client"])->first()->id,
            'vendor_id' => $request->input('vendor_id'),
        ]);

        return redirect()->route('client.show', $client)->with('success', 'Client updated successfully.');
    }

    /**
     *  this function updates the password of the client
     * @param Request $request
     * @return RedirectResponse
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $user = Auth::user();

        // validate the request data
        $request->validate([
            'currentPassword' => 'required|string|min:8',
            'newPassword' => 'required|string|min:8',
            'confirmPassword' => 'required|string|min:8',
        ]);

        // for security reasons, we check if the current password is correct
        // if not, we return an error
        if (!Hash::check($request->input('currentPassword'), $user->password)) {
            return redirect()->route('profile.index')->with('error', 'Current password is incorrect.');
        }

        // for security reasons, we check if the new password and confirm password are same
        // if not, we return an error
        if ($request->input('newPassword') !== $request->input('confirmPassword')) {
            return redirect()->route('profile.index')->with('error', 'New password and confirm password do not match.');
        }

        // for security reasons, we check if the new password is same as the current password
        // if yes, we return an error
        if (Hash::check($request->input('newPassword'), $user->password)) {
            return redirect()->route('profile.index')->with('error', 'New password cannot be same as current password.');
        }

        // if all the validations are passed, we update the password
        $user->password = Hash::make($request->input('newPassword'));
        $user->save();

        return redirect()->route('profile.index')->with('success', 'Password updated successfully.');
    }
}
