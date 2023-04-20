<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Client;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $clients = Client::with('role')->where("vendor_id", '!=', null)->get();
        $permissions = Permission::all();
        return view('admin.permission', compact('clients', 'permissions'));
    }

    public function store(Request $request)
    {
        $permissions = $request->input('permissions');
        foreach ($permissions as $permission) {
            $client = Client::find($request->input('client_id'));
            $client->givePermissionTo($permission);
        }
        return redirect()->route('permission.index')->with('success', 'Permissions assigned successfully!');
    }

}
