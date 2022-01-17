<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TasksDocuments extends Model
{
    protected $fillable = ['doc_path', 'user_id'];

    public function docsUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
