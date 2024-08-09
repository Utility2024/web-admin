<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Althinect\FilamentSpatieRolesPermissions\Concerns\HasSuperAdmin;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    const ROLE_SUPERADMIN = 'SUPERADMIN';
    const ROLE_ADMINESD = 'ADMINESD';
    const ROLE_ADMINHR = 'ADMINHR';
    const ROLE_ADMINGA = 'ADMINGA';
    const ROLE_ADMINUTILITY = 'ADMINUTILITY';
    const ROLE_USER = 'USER';

    const ROLES = [
        self::ROLE_SUPERADMIN => 'SuperAdmin',
        self::ROLE_ADMINESD => 'Admin ESD',
        self::ROLE_ADMINHR => 'Admin HR',
        self::ROLE_ADMINGA => 'Admin GA',
        self::ROLE_ADMINUTILITY => 'Admin Utility',
        self::ROLE_USER => 'User',
    ];

    protected $fillable = [
        'nik',
        'name',
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // SuperAdmin can access all panels
        if ($this->role === self::ROLE_SUPERADMIN) {
            return true;
        }

        // Admin ESD can access only 'esd' and 'stock' panels
        if ($this->role === self::ROLE_ADMINESD) {
            return in_array($panel->getId(), ['esd', 'stock']);
        }

        // Admin HR can access only 'hr' and 'stock' panels
        if ($this->role === self::ROLE_ADMINHR) {
            return in_array($panel->getId(), ['hr', 'stock']);
        }

        // Admin GA can access only 'ga' and 'stock' panels
        if ($this->role === self::ROLE_ADMINGA) {
            return in_array($panel->getId(), ['ga', 'stock']);
        }

        // Admin Utility can access only 'utility' and 'stock' panels
        if ($this->role === self::ROLE_ADMINUTILITY) {
            return in_array($panel->getId(), ['utility', 'stock']);
        }

        // User can access only 'esd' panel
        if ($this->role === self::ROLE_USER) {
            return $panel->getId() === 'esd';
        }

        // Default deny access
        return false;
    }

    public function isSuperAdmin()
    {
        return $this->role === self::ROLE_SUPERADMIN;
    }

    public function isAdminESD()
    {
        return $this->role === self::ROLE_ADMINESD;
    }

    public function isAdminHR()
    {
        return $this->role === self::ROLE_ADMINHR;
    }

    public function isAdminGA()
    {
        return $this->role === self::ROLE_ADMINGA;
    }

    public function isAdminUtility()
    {
        return $this->role === self::ROLE_ADMINUTILITY;
    }

    public function isUser()
    {
        return $this->role === self::ROLE_USER;
    }
}
