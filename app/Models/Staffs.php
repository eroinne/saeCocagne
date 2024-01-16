<?php

namespace App\Models;

use App\Models\Structures;
use Illuminate\Support\Facades\Auth;
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

    /**
     * Function to know if the staff can edit about a structure
     */
    public function canAct($structures_id){

        // Check if the structure exists
        $structure = Structures::find($structures_id);

        if($structure == null)
            return 0;

        // Check if the user is admin or a moderator of the structure
        if( Auth::guard('staffs')->user()->is_admin != 1 && Auth::guard('staffs')->user()->structures_id != $structure->id){
            // If not admin
            return 0;
        }

        return 1;
    }

}
