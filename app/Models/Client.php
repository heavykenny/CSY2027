<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as AuthenticateClient;
use JetBrains\PhpStorm\NoReturn;

class Client extends AuthenticateClient
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'vendor_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function hasPermissionTo($permissionName): bool
    {
        $permissions = $this->role->permissions()->where('name', $permissionName)->get();
        return !$permissions->isEmpty();
    }

    #[NoReturn] public function givePermissionTo($permissionName)
    {
        $permission = Permission::where('id', $permissionName)->firstOrFail();
        $this->role->permissions()->syncWithoutDetaching($permission->id);
    }



}
