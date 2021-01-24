<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
      'name', 'matter', 'staff', 'start_date', 'end_date', 'content', 'status', 'important', 'user_id',
    ];

    public function user(){
      return $this->belongsTo('App\User');
    }
}
