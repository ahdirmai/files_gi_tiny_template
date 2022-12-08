<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'division_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function basefolder()
    {
        return $this->hasMany(BaseFolder::class, 'owner_id', 'id');
    }
    public function access()
    {
        return $this->hasMany(Access::class, 'user_id', 'id');
    }

    public function initials()
    {
        $words = explode(" ", $this->name);
        $initials = null;
        foreach ($words as $w) {
            $initials .= $w[0];
        }
        return strtoupper($initials);
    }
}
