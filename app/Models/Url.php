<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;
    protected $fillable=['name','user_id','link','short_link','count'];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
