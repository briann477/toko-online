<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Tabel yang digunakan
    protected $table = 'user';

    // Kolom yang bisa diisi mass-assignment
    protected $fillable = [
        'nama',
        'email',
        'role',
        'status',
        'password',
        'hp',
        'foto',
    ];

    // Kolom yang disembunyikan saat data diambil
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Format tipe data
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'status' => 'boolean',
        'role' => 'integer',
    ];
}
