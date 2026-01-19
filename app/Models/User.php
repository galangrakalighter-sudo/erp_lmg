<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'hod',
        'dmm',
        'dm',
        'cc',
        'divisi',
        'client',
    ];
    
    protected $casts = [
        'divisi' => 'array',
        'client' => 'array',
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

    public function many_dmm(): HasMany {
        return $this->hasMany(User::class, 'hod');
    }

    public function many_dm(): HasMany {
        return $this->hasMany(User::class, 'dmm');
    }

    public function many_cc(): HasMany {
        return $this->hasMany(User::class, 'dm');
    }

    // --- Relasi ATASAN (BelongsTo) ---
    public function as_hod(): BelongsTo {
        return $this->belongsTo(User::class, 'hod');
    }

    public function as_dmm(): BelongsTo {
        return $this->belongsTo(User::class, 'dmm');
    }

    public function as_dm(): BelongsTo {
        return $this->belongsTo(User::class, 'dm');
    }

    public function as_cc(): BelongsTo {
        return $this->belongsTo(User::class, 'cc');
    }
}
