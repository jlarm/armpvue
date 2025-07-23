<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'consultant_id',
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
            'password' => 'hashed',
        ];
    }

    public function consultant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'consultant_id');
    }

    public function employees(): HasMany
    {
        return $this->hasMany(User::class, 'consultant_id');
    }

    public function dealerships(): BelongsToMany
    {
        return $this->belongsToMany(Dealership::class)->withTimestamps();
    }

    public function stores(): BelongsToMany
    {
        return $this->belongsToMany(Store::class)->withTimestamps();
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'user_permissions')
            ->withPivot('store_id')
            ->withTimestamps();
    }

    public function createdDealerships(): HasMany
    {
        return $this->hasMany(Dealership::class, 'created_by');
    }

//    public function audits(): HasMany
//    {
//        return $this->hasMany(Audit::class, 'created_by');
//    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isConsultant(): bool
    {
        return $this->role === 'consultant';
    }

    public function isEmployee(): bool
    {
        return $this->role === 'employee';
    }

    public function hasPermission(string $permission, ?int $storeId = null): bool
    {
        if ($this->isAdmin()) {
            return true;
        }

        if ($storeId !== null && $storeId !== 0) {
            return $this->permissions()
                ->where('name', $permission)
                ->wherePivot('store_id', $storeId)
                ->exists();
        }

        return $this->permissions()->where('name', $permission)->exists();
    }

    public function canAccessDealership(int $dealershipId): bool
    {
        if ($this->isAdmin()) {
            return true;
        }

        return $this->dealerships()->where('dealership_id', $dealershipId)->exists();
    }
}
