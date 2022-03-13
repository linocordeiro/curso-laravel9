<?php

namespace App\Models;

use Dotenv\Util\Str;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function getUsers(string $search)

    public function getUsers(string $search = null)
    {
        $users = $this->where(function ($query) use ($search) {
            if ($search) {
                // dd($search);
                $query->where('email', 'like', "%{$search}%");
                $query->orWhere('name', 'like', "%{$search}%");
            }
        })->get();

        return $users;
    }

    public function comments()
    {
        // usar este se as colunas nao seguem o padrao do laravel
        // return $this->hasMany(Comment::class,'user_id', 'id');
        return $this->hasMany(Comment::class);
    }
}
