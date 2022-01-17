<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use App\Tasks;
use App\TasksComments;
use App\TasksDocuments;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

// use Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('task_manage')) {
            return abort(401);
        }
        
        $tasks = Tasks::where('assign_to', auth()->id())->get();
        if(Auth::user()->roles[0]->id == 1){
            $tasks = Tasks::all();
        }
        
        return view('admin.tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('task_add')) {
            return abort(401);
        }
         
        $users = User::all();
        return view('admin.tasks.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('task_add')) {
            return abort(401);
        }
        $data = $request->all();
        $data['assignee'] = auth()->id();

        $role = Tasks::create($data);
        return redirect()->route('admin.tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function show(Tasks $task)
    {
        if (! Gate::allows('task_view')) {
            return abort(401);
        }

        $task->load('assignedBy');
        $task->load('assignTo');
        $task->load('taskComments');
        $task->load('taskComments.commentUser');
        $task->load('taskDocs');
        $task->load('taskDocs.docsUser');
        if(Auth::user()->roles[0]->id > 1){
            $task->where('assign_to', auth()->id());
        }
        $tasks = $task;
        
        Notification::where('user_id', auth()->id())->where('task_id', $task->id)->update(['status' => 1]); 
         
        return view('admin.tasks.show', compact('tasks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function edit(Tasks $task)
    {
        if (! Gate::allows('task_update')) {
            return abort(401);
        }

        $task->load('assignedBy');
        $task->load('assignTo');
        
        if(Auth::user()->roles[0]->id > 1){
            $task->where('assign_to', auth()->id());
        }
        Notification::where('user_id', auth()->id())->where('task_id', $task->id)->update(['status' => 1]); 
        $tasks = $task;
        $users = User::all();
        return view('admin.tasks.edit', compact('tasks', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tasks $task)
    {
        if (! Gate::allows('task_update')) {
            return abort(401);
        }

        if($request->input('assign_to') != ""){
            $getNotification = Notification::where('user_id', $request->input('assign_to'))->where('task_id', $task->id)->count();
            if($getNotification == 0){
                $notify = new Notification;
                $notify->user_id = $request->input('assign_to');
                $notify->task_id = $task->id; 
                $notify->message = Auth::user()->name." assign new task #".$task->id;
                $notify->save();
                
            }
        }
        
        $task->update($request->except('comment','task_docs'));

        if(!empty($request->input('comment'))){
            $comment = new TasksComments;
            $comment->user_id = auth()->id();
            $comment->task_id = $task->id; 
            $comment->comment = $request->input('comment');
            $comment->save();
        }

        
        if($request->hasfile('task_docs'))
         {            
            foreach($request->file('task_docs') as $file)
            {
                $name = time().rand(1,100).'.'.$file->extension();
                $file->move(public_path('uploads'), $name);
                $task_docs = new TasksDocuments;
                $task_docs->user_id = auth()->id();
                $task_docs->task_id = $task->id; 
                $task_docs->doc_path = $name;
                $task_docs->save();
            }
         }


        return redirect()->route('admin.tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tasks $task)
    {
        if (! Gate::allows('task_delete')) {
            return abort(401);
        }
        
        $task->delete();
        return redirect()->route('admin.tasks.index');
    }
}
