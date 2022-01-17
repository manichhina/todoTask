<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class TasksComments extends Model
{
    protected $fillable = ['comment', 'user_id'];

    public function commentUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
