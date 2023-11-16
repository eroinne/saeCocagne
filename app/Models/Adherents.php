<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Adherents extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        'password' => 'hashed',
    ];


    // has many commandes
    /**
     * Get the adherent's commandes.
     */
    public function commandes()
    {
        return $this->hasMany(Commandes::class);
    }

    // belongs To abonnements
    /**
     * Get the adherent's abonnements.
     */
    public function abonnements()
    {
        return $this->belongsTo(Abonnements::class);
    }

    // belongs To structure
    /**
     * Get the adherent's structure.
     */

    public function structure()
    {
        return $this->belongsTo(Structures::class);
    }







}
