<?php

namespace App;

use App\User;
use App\TasksComments;
use App\TasksDocuments;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Tasks extends Model
{
    use Notifiable;
    use HasRoles;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'todo_tasks';


    protected $fillable = ['id', 'title', 'description', 'assignee', 'assign_to', 'from_start', 'from_end', 'status'];
        
    public function assignedBy()
    {
        return $this->hasOne(User::class, 'id', 'assignee');
    }

    public function assignTo()
    {
        return $this->hasOne(User::class, 'id', 'assign_to');
    }

    public function taskComments()
    {
        return $this->hasMany(TasksComments::class, 'task_id', 'id');
    }

    public function taskDocs()
    {
        return $this->hasMany(TasksDocuments::class, 'task_id', 'id');
    }

}
