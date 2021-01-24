<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matter extends Model
{
    protected $fillable = [
      'name', 'content', 'rank', 'user_id',
    ];

    public function user(){
      return $this->belongsTo('App\User');
    }
}
