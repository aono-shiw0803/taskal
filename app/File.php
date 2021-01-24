<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
      'file', 'matter', 'type', 'content', 'user_id',
    ];

    public function user(){
      return $this->belongsTo('App\User');
    }
}
