<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'profile_status', 'verification_note'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function registeredEvents()
    {
        return $this->belongsToMany(Event::class, 'event_registrations')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function umkmProfile()
    {
        return $this->hasOne(UmkmProfile::class);
    }

    public function pengajuanPendanaans()
    {
        return $this->hasMany(PengajuanPendanaan::class);
    }
}
