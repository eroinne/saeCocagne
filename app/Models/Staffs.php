<?php

namespace App\Models;

use App\Models\Structures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Staffs extends Authenticatable
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the structure of the staff
     */
    public function structure(){
        return $this->belongsTo(Structures::class);
    }

}
