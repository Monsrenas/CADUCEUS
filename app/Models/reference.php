<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reference extends Model
{
    use HasFactory;
    protected $fillable = array('applicant_id',
                                'persons');

    public function applicant() 
    {
        return $this->hasOne(applicants::class,'id','applicant_id');
    }
}
