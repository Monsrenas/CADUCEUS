<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class applicant extends Model
{
    use HasFactory;
    protected $fillable = array('user_id',
                                'type_of_job',
                                'process_state',
                                'reference_persons','evaluation');

    public function user() 
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function reference() 
    {
        return $this->hasOne(reference::class,'applicant_id','id');
    }

    public function documents() 
    {
        return $this->hasMany(documents::class,'user_id','user_id');
    }

}
