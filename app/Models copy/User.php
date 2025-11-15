<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Allowed roles for clarity across the app.
     */
    public const ROLES = ['admin', 'staff', 'student'];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',   // <-- added
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    /* ------------------------------
     | Role helpers
     |------------------------------*/
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isStaff(): bool
    {
        return $this->role === 'staff';
    }

    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    /**
     * Normalize role on set (lowercase, fallback to 'student' if invalid).
     */
    public function setRoleAttribute($value): void
    {
        $role = strtolower((string) $value);
        $this->attributes['role'] = in_array($role, self::ROLES, true) ? $role : 'student';
    }

    /**
     * Quick scope to filter by role.
     */
    public function scopeRole($query, string $role)
    {
        return $query->where('role', $role);
    }
}
