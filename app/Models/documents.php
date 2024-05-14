<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class documents extends Model
{
    use HasFactory;

    protected $fillable = array('file',
                                'code_id',
                                'user_id',
                                'state','expiration');

    public function doc_type() 
    {
        return $this->hasOne(document_type::class,'id','code_id');
    }
    public function user() 
    {
        return $this->hasOne(user::class,'id','user_id');
    }
}
