<?php

namespace ExpenseManager;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getRole()
    {
        return $this->roles()->first() ?: abort(401, 'No role attached to the user.');
    }

    public function hasAnyRole(array $roles)
    {
        return (bool) $this->roles()->whereIn('display_name', $roles)->count() ? true : false;
    }

    public function hasRole($roles)
    {
        return (bool) $this->roles()->where('display_name', $roles)->count() ? true : false;
    }

    public function isAdmin()
    {
        return $this->hasRole('Administrator');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
