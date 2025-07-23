<?php

namespace App\Domains\Store\Models;

use App\Domains\Dealership\Models\Dealership;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Store extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'is_main_store' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function dealership(): BelongsTo
    {
        return $this->belongsTo(Dealership::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->where('role', 'employee')
            ->withTimestamps();
    }

    public function userPermissions(): HasMany
    {
        return $this->hasMany(UserPermission::class);
    }

    public function scopeMainStore($query)
    {
        return $query->where('is_main_store', true);
    }
}
